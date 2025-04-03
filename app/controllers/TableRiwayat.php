<?php
class TableRiwayat extends Controller
{
    // Ensure user is logged in
    private function ensureLoggedIn()
    {
        if (!isset($_SESSION['login_admin'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }
    }

    // Load common data for views
    private function loadCommonData($title)
    {
        return [
            'title' => $title,
            'file'=>'riwayat',
            'riwayat' => 'active',
            'dashboard' => 'subdrop',
            'transaksi' => 'submenu',
            'kelola' => 'submenu',
            'pembayaran' => '',
            'petugas' => '',
            'kategori' => '',
            'warga' => '',
            'admin' => ''
        ];
    }

    public function index()
    {
        $this->ensureLoggedIn();

        $data = $this->loadCommonData('Data Riwayat');
        $data['data'] = $this->model('Transaction_model')->getHistoryTransaction();

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/riwayatData', $data);
        $this->view('templates/footers/FooterAdmin');
    }

    public function confirmRiwayat()
    {
        $this->ensureLoggedIn();

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data = $this->loadCommonData('Data Riwayat');
            $data['link'] = 'Riwayat';
            $data['transaction'] = $this->model('Transaction_model')->getTransactionByHashId($id);
            $data['categories'] = $this->model('Category_model')->getAllCategory();
            $this->view('templates/headers/HeaderAdmin', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $this->view('admin/confirmTransaksi', $data);
            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('error/error-404');
        }
    }

    public function updateRiwayat()
    {
        $this->ensureLoggedIn();

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data['link'] = 'Riwayat';
            $data = $this->loadCommonData('Data Riwayat');
            $data['transaction'] = $this->model('Transaction_model')->getTransactionByHashId($id);
            $data['categories'] = $this->model('Category_model')->getAllCategory();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->view('templates/headers/HeaderAdminProcess', $data);
                $this->view('templates/sidebar/sidebarAdmin', $data);
                $result = $this->processRiwayatUpdate($id, $data);
                $this->displayTransactionUpdateResult($result);
                $this->view('admin/confirmTransaksi', $data);
                $this->view('templates/footers/FooterAdmin');
            } else {
                $this->view('templates/headers/HeaderAdmin', $data);
                $this->view('templates/sidebar/sidebarAdmin', $data);
                $this->view('admin/confirmTransaksi', $data);
                $this->view('templates/footers/FooterAdmin');
            }
        } else {
            $this->view('error/error-404');
        }
    }

    public function processRiwayatUpdate($id, $data)
    {
        $category = intval($_POST['category']);
        $berat = $_POST['weight'];
        $bonus = $_POST['bonus'];
        $condition = $_POST['kondisi'];
        $status = $_POST['status'];
        $desc = htmlspecialchars($_POST['desc']);

        $data['categories'] = $this->model('Category_model')->getCategoryById($category);
        $price = $data['categories'];
        $dataTrans = $data['transaction'];
        $amount = ($price['category_price'] * $berat) + $bonus;

        if ($status == 'Selesai') {
            if ($amount >= $dataTrans['amount']) {
                $total = $amount - $dataTrans['amount'];
                $balance = $dataTrans['balance'] + $total;
            } else {
                $total = $dataTrans['amount'] - $amount;
                $balance = $dataTrans['balance'] - $total;
            }
            $updateTransaction = $this->model('Transaction_model')->updateTransaction($id, $amount, 'Selesai', $desc);
            $updatePickup = $this->model('Pickup_model')->updatePickup($dataTrans['pickup_id'], $berat, $category, $condition, $data['pickup_note'], 'Selesai');
            $addBalance = $this->model('Account_model')->addBalance($dataTrans['account_id'], $balance);

            return $updateTransaction && $updatePickup && $addBalance ? 'success' : 'error';
        } elseif ($status == 'Dibatalkan') {
            $updateTransaction = $this->model('Transaction_model')->updateTransaction($id, 0, $status, $desc);
            $updatePickup = $this->model('Pickup_model')->updatePickup($dataTrans['pickup_id'], 0, $category, $condition, $data['pickup_note'], 'Selesai');
            $updateBalance = $this->model('Account_model')->addBalance($dataTrans['account_id'], ($dataTrans['balance'] - $dataTrans['amount']));

            return $updateTransaction && $updatePickup && $updateBalance ? 'canceled' : 'error';
        } else {
            $updateTransaction = $this->model('Transaction_model')->updateTransaction($id, $amount, $status, $desc);
            $updatePickup = $this->model('Pickup_model')->updatePickup($dataTrans['pickup_id'], $berat, $category, $condition, $data['pickup_note'], 'Selesai');
            $updateBalance = $this->model('Account_model')->addBalance($dataTrans['account_id'], ($dataTrans['balance'] - $dataTrans['amount']));

            return $updateTransaction && $updatePickup && $updateBalance ? 'processed' : 'error';
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
            case 'deleted':
                echo "<script language='javascript'>swal('Selamat...', 'Pembayaran dihapus', 'success');</script>";
                break;
            default:
                echo "<script language='javascript'>swal('Gagal...', 'Maaf, ada sedikit kesalahan', 'error');</script>";
                break;
        }
        echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableRiwayat/index">';
    }

    public function deleteRiwayat()
    {
        $this->ensureLoggedIn();

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data['link'] = 'Riwayat';
            $data = $this->loadCommonData('Data Riwayat');
            $data['transaction'] = $this->model('Transaction_model')->getTransactionByHashId($id);
            $data['data'] = $this->model('Transaction_model')->getHistoryTransaction();

            $this->view('templates/headers/HeaderAdminProcess', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);

            $trans = $data['transaction'];
            $deleteTransaction = $this->model('Transaction_model')->deleteTransaction($id);
            $deletePickup = $this->model('Pickup_model')->deletePickup($trans['pickup_id']);
            $result = $deleteTransaction && $deletePickup ? 'deleted' : 'error';
            
            $this->displayTransactionUpdateResult($result);
            $this->view('admin/riwayatData', $data);
            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('error/error-404');
        }
    }

    public function printRiwayat()
    {
        $this->ensureLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $filter = $_POST['filter'];
            $inputFilter = htmlspecialchars($_POST['input-filter']);

            $data =
                [
                    'waktu' => date('d-m-Y'),
                    'riwayat' => $this->model('Transaction_model')->getHistoryPrintTransaction($filter, $inputFilter, 'Sedang Diproses')
                ];

            $this->view('admin/printRiwayat', $data);
        }
    }
}
