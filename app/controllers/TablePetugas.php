<?php
class TablePetugas  extends Controller
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
            'file'=>'petugas',
            'petugas' => 'active',
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

        $data = $this->loadCommonData('Data Staff');
        $data['data'] = $this->model('User_model')->getUsersByNotRole('3');

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/petugasData', $data);
        $this->view('templates/footers/FooterAdmin');
    }

    public function addPetugas()
    {
        $this->ensureLoggedIn();
        $data = $this->loadCommonData('Data Staff');

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/addPetugas');
        $this->view('templates/footers/FooterAdmin');
    }

    public function editPetugas()
    {
        $this->ensureLoggedIn();
        $data = $this->loadCommonData('Data Staff');

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data['petugas'] = $this->model('User_model')->getUserByHashId($id);
            $this->view('templates/headers/HeaderAdmin', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $this->view('admin/editPetugas', $data);
            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('error/error-404');
        }
    }

    public function createPetugas()
    {
        $this->ensureLoggedIn();
        $data = $this->loadCommonData('Data Staff');

        $this->view('templates/headers/HeaderAdminProcess', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/addPetugas');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userName = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $fullName = htmlspecialchars($_POST['name']);
            $nip = htmlspecialchars($_POST['nip']);
            $telp = htmlspecialchars($_POST['telp']);
            $roleId = intval($_POST['role']);
            $address = htmlspecialchars($_POST['address']);
            $rt = htmlspecialchars($_POST['rt']);
            $password = password_hash('111111', PASSWORD_DEFAULT);

            $result = $this->model('User_model')->createUser($userName, $password, $email, $fullName, $nip, $telp, $roleId, $address, $rt);

            if ($result) {
                echo "<script language='javascript'>swal('Selamat...', 'Data berhasil ditambahkan', 'success');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TablePetugas/index">';
            } else {
                echo "<script language='javascript'>swal('Gagal...', 'Maaf, ada data duplikat dengan data lain', 'error');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TablePetugas/addPetugas">';
            }
        }
        $this->view('templates/footers/FooterAdmin');
    }

    public function updatePetugas()
    {
        $this->ensureLoggedIn();
        $data = $this->loadCommonData('Data Staff');

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $this->view('templates/headers/HeaderAdminProcess', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $data['petugas'] = $this->model('User_model')->getUserByHashId($id);
            $this->view('admin/editPetugas', $data);

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $userName = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $fullName = htmlspecialchars($_POST['name']);
                $nip = htmlspecialchars($_POST['nip']);
                $telp = htmlspecialchars($_POST['telp']);
                $roleId = intval($_POST['role']);
                $address = htmlspecialchars($_POST['address']);
                $rt = htmlspecialchars($_POST['rt']);
                $petugas = $data['petugas'];
                $userId = $petugas['user_id'];

                $result = $this->model('User_model')->updateUser($userId, $userName, $nip, $fullName, $email, $address, $rt, $telp, $roleId);

                if ($result) {
                    echo "<script language='javascript'>swal('Selamat...', 'Data berhasil diubah', 'success');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TablePetugas/index">';
                } else {
                    echo "<script language='javascript'>swal('Gagal...', 'Maaf, ada data duplikat dengan data lain', 'error');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TablePetugas/editPetugas">';
                }
            }
            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('error/error-404');
        }
    }

    public function deletePetugas()
    {
        $this->ensureLoggedIn();
        $data = $this->loadCommonData('Data Staff');

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data['data'] = $this->model('User_model')->getUsersByNotRole('3');
            $this->view('templates/headers/HeaderAdminProcess', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $this->view('admin/petugasData', $data);

            $userId = $this->model('User_model')->getUserByHashId($id);
            $result = $this->model('User_model')->deleteUser($userId['user_id']);

            if ($result) {
                echo "<script language='javascript'>swal('Selamat...', 'Data berhasil dihapus', 'success');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TablePetugas/index">';
            } else {
                echo "<script language='javascript'>swal('Gagal...', 'Maaf, ada kesalahan pada proses', 'error');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TablePetugas/index">';
            }

            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('error/error-404');
        }
    }

    public function printPetugas()
    {
        $this->ensureLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $filter = $_POST['filter'];
            $inputFilter = htmlspecialchars($_POST['input-filter']);

            $data = 
            [
                'waktu' => date('d-m-Y'),
                'petugas'=>$this->model('User_model')->getPrintUser($filter, $inputFilter)
            ];

           $this->view('admin/printPetugas', $data);
        }
    }
}
