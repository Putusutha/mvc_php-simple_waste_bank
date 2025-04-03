<?php
class TablePembayaran extends Controller
{
    // Ensure user is logged in
    private function ensureLoggedIn() {
        if (!isset($_SESSION['login_admin'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }
    }

    // Load common data for views
    private function loadCommonData($title) {
        return [
            'title' => $title,
            'file'=>'pembayaran',
            'pembayaran' => 'active',
            'dashboard' => 'subdrop',
            'transaksi' => 'submenu',
            'kelola' => 'submenu',
            'riwayat' => '',
            'petugas' => '',
            'kategori' => '',
            'warga' => '',
            'admin' => ''
        ];
    }

    public function index()
    {
        $this->ensureLoggedIn();

        $data = $this->loadCommonData('Data Pembayaran');
        $data['data'] = $this->model('Transaction_model')->getAllTransaction('Sedang Diproses');

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/pembayaranData', $data);
        $this->view('templates/footers/FooterAdmin');
    }

    public function confirmTransaksi()
    {
        $this->ensureLoggedIn();

        if (!isset($_GET['data'])) {
            $this->view('error/error-404');
            return;
        }

        $data = $this->loadCommonData('Data Pembayaran');
        $data['link'] = 'Pembayaran';
        $id = $_GET['data'];
        $data['transaction'] = $this->model('Transaction_model')->getTransactionByHashId($id);
        $data['categories'] = $this->model('Category_model')->getAllCategory();

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/confirmTransaksi', $data);
        $this->view('templates/footers/FooterAdmin');
    }


    public function updatePembayaran()
    {
        $this->ensureLoggedIn();

        if (!isset($_GET['data'])) {
            $this->view('error/error-404');
            return;
        }

        $id = $_GET['data'];
        $data = $this->loadCommonData('Data Pembayaran');
        $data['link'] = 'Pembayaran';
        $data['transaction'] = $this->model('Transaction_model')->getTransactionByHashId($id);
        $data['categories'] = $this->model('Category_model')->getAllCategory();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->view('templates/headers/HeaderAdminProcess', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $result = $this->processTransactionUpdate($id, $data);
            $this->displayTransactionUpdateResult($result);
            $this->view('admin/confirmTransaksi', $data);
            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('templates/headers/HeaderAdmin', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $this->view('admin/confirmTransaksi', $data);
            $this->view('templates/footers/FooterAdmin');
        }
    }

    // Process the transaction update
    private function processTransactionUpdate($id, $data)
    {
        $category = intval($_POST['category']);
        $berat = $_POST['weight'];
        $bonus = $_POST['bonus'];
        $condition = $_POST['kondisi'];
        $status = $_POST['status'];
        $desc = htmlspecialchars($_POST['desc']);

        $categoryData = $this->model('Category_model')->getCategoryById($category);
        $transactionData = $data['transaction'];
        $amount = ($categoryData['category_price'] * $berat) + $bonus;

        if ($status == 'Selesai') {
            $updateTransaction = $this->model('Transaction_model')->updateTransaction($id, $amount, 'Selesai', $desc);
            $updatePickup = $this->model('Pickup_model')->updatePickup($transactionData['pickup_id'], $berat, $category, $condition, $transactionData['pickup_note'], 'Selesai');
            $addBalance = $this->model('Account_model')->addBalance($transactionData['account_id'], ($transactionData['balance'] + $amount));

            return $updateTransaction && $updatePickup && $addBalance ? 'success' : 'error';
        } elseif ($status == 'Dibatalkan') {
            $updateTransaction = $this->model('Transaction_model')->updateTransaction($id, 0, $status, $desc);
            $updatePickup = $this->model('Pickup_model')->updatePickup($transactionData['pickup_id'], 0, $category, $condition, $transactionData['pickup_note'], 'Selesai');

            return $updateTransaction && $updatePickup ? 'canceled' : 'error';
        } else {
            $updateTransaction = $this->model('Transaction_model')->updateTransaction($id, $amount, $status, $desc);
            $updatePickup = $this->model('Pickup_model')->updatePickup($transactionData['pickup_id'], $berat, $category, $condition, $transactionData['pickup_note'], 'Selesai');

            return $updateTransaction && $updatePickup ? 'processed' : 'error';
        }
    }

    // Display the result of transaction update
    private function displayTransactionUpdateResult($result)
    {
        switch ($result) {
            case 'success':
                echo "<script language='javascript'>swal('Selamat...', 'Pembayaran berhasil diselesaikan', 'success');</script>";
                break;
            case 'canceled':
                echo "<script language='javascript'>swal('Selamat...', 'Pembayaran dibatalkan', 'success');</script>";
                break;
            case 'processed':
                echo "<script language='javascript'>swal('Selamat...', 'Pembayaran diproses', 'success');</script>";
                break;
            default:
                echo "<script language='javascript'>swal('Gagal...', 'Maaf, ada sedikit kesalahan', 'error');</script>";
                break;
        }
        echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TablePembayaran/index">';
    }

    public function printPembayaran()
    {
        $this->ensureLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $filter = $_POST['filter'];
            $inputFilter = htmlspecialchars($_POST['input-filter']);

            $data = 
            [
                'waktu' => date('d-m-Y'),
                'pembayaran'=>$this->model('Transaction_model')->getPrintTransaction($filter, $inputFilter, 'Sedang Diproses')
            ];

           $this->view('admin/printPembayaran', $data);
        }
    }
}
