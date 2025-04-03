<?php
class TableWarga extends Controller
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
            'file'=>'warga',
            'warga' => 'active',
            'dashboard' => 'subdrop',
            'transaksi' => 'submenu',
            'kelola' => 'submenu',
            'pembayaran' => '',
            'petugas' => '',
            'kategori' => '',
            'warga' => '',
            'riwayat' => ''
        ];
    }

    public function index()
    {
        $this->ensureLoggedIn();

        $data = $this->loadCommonData('Data Warga');
        $data['data'] = $this->model('Account_model')->getAccountsByRole('3');

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/wargaData', $data);
        $this->view('templates/footers/FooterAdmin');
    }

    public function addWarga()
    {
        $this->ensureLoggedIn();

        $data = $this->loadCommonData('Data Warga');

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/addWarga');
        $this->view('templates/footers/FooterAdmin');
    }

    public function createWarga()
    {
        $this->ensureLoggedIn();

        $data = $this->loadCommonData('Data Warga');

        $this->view('templates/headers/HeaderAdminProcess', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/addWarga');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userName = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $fullName = htmlspecialchars($_POST['name']);
            $nip = htmlspecialchars($_POST['nip']);
            $telp = htmlspecialchars($_POST['telp']);
            $address = htmlspecialchars($_POST['address']);
            $rt = htmlspecialchars($_POST['rt']);
            $password = password_hash('111111', PASSWORD_DEFAULT);

            $result = $this->model('Account_model')->createAccount($userName, $password, $email, $fullName, $nip, $telp, 3, $address, $rt);

            if ($result) {
                echo "<script language='javascript'>swal('Selamat...', 'Data berhasil ditambahkan', 'success');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableWarga/index">';
            } else {
                echo "<script language='javascript'>swal('Gagal...', 'Maaf, ada data duplikat dengan data lain', 'error');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableWarga/addWarga">';
            }
        }
        $this->view('templates/footers/FooterAdmin');
    }

    public function editWarga()
    {
        $this->ensureLoggedIn();

        $data = $this->loadCommonData('Data Warga');

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data['warga'] = $this->model('Account_model')->getAccountByHashId($id);
            $this->view('templates/headers/HeaderAdmin', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $this->view('admin/editWarga', $data);
            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('error/error-404');
        }
    }

    public function updateWarga()
    {
        $this->ensureLoggedIn();

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data = $this->loadCommonData('Data Warga');

            $this->view('templates/headers/HeaderAdminProcess', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $data['warga'] = $this->model('Account_model')->getAccountByHashId($id);
            $this->view('admin/editWarga', $data);

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $balance = $_POST['balance'];
                $warga = $data['warga'];
                $total = $warga['balance'] - $balance;

                $result = $this->model('Account_model')->updateBalance($id, $total);

                if ($result) {
                    echo "<script language='javascript'>swal('Selamat...', 'Saldo berhasil dipotong', 'success');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableWarga/index">';
                } else {
                    echo "<script language='javascript'>swal('Gagal...', 'Maaf, ada kesalahan saat proses', 'error');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableWarga/editWarga">';
                }
            }
            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('error/error-404');
        }
    }

    public function deleteWarga()
    {
        $this->ensureLoggedIn();
        $data = $this->loadCommonData('Data Warga');

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data['data'] = $this->model('Account_model')->getAccountsByRole('3');
            $this->view('templates/headers/HeaderAdminProcess', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $this->view('admin/wargaData', $data);

            $userId = $this->model('Account_model')->getAccountByHashId($id);
            $deleteAccount = $this->model('Account_model')->deleteAccount($id);
            $deleteUser = $this->model('User_model')->deleteUser($userId['user_id']);

            if ($deleteAccount && $deleteUser) {
                echo "<script language='javascript'>swal('Selamat...', 'Data berhasil dihapus', 'success');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableWarga/index">';
            } else {
                echo "<script language='javascript'>swal('Gagal...', 'Maaf, ada kesalahan pada proses', 'error');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableWarga/index">';
            }

            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('error/error-404');
        }
    }

    public function printWarga()
    {
        $this->ensureLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $filter = $_POST['filter'];
            $inputFilter = htmlspecialchars($_POST['input-filter']);

            $data = 
            [
                'waktu' => date('d-m-Y'),
                'warga'=>$this->model('Account_model')->getPrintAccount($filter, $inputFilter)
            ];

           $this->view('admin/printWarga', $data);
        }
    }
}
