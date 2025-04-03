<?php
class Admin extends Controller
{

    public function index()
    {
        // Pastikan pengguna telah login
        if (!isset($_SESSION['login_admin'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }

        $data['title'] = 'Dashboard';
        $data['file'] = 'Dashboard';
        $data['transactions'] = $this->model('Transaction_model')->countTransaction();
        $data['users'] = $this->model('User_model')->countUser();
        $data['recent_pickup'] = $this->model('Pickup_model')->getRecentPickups();
        $data['dashboard'] = 'active';
        $data['transaksi'] = $data['kelola'] = 'submenu';
        $data['riwayat'] =  $data['pembayaran'] =  $data['warga'] = $data['admin'] =  $data['petugas'] =  $data['kategori'] = '';

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footers/FooterAdmin');
    }

    public function profile()
    {
         // Pastikan pengguna telah login
         if (!isset($_SESSION['login_admin'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }

        $data = [
            'title' => 'Profil Anda',
            'file' => 'profileAdmin',
            'url' => '/admin/index',
            'jenis' => 'admin',
            'dashboard'=>'subdrop',
            'transaksi'=>'submenu',
            'kelola'=>'submenu',
            'riwayat'=>'',
            'pembayaran'=>'',
            'warga'=>'',
            'admin'=>'',
            'petugas'=>'',
            'kategori'=>'',
            'data_user' => $this->model('User_model')->getUserById($_SESSION['id_admin'])
        ];

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/profile', $data);
        $this->view('templates/footers/FooterAdmin');
    }

    public function updateProfileOrPassword($type = 'profile')
    {
        $data = [
            'title' => 'Profil Anda',
            'file' => 'profileAdmin',
            'url' => '/admin/index',
            'jenis' => 'admin',
            'dashboard'=>'subdrop',
            'transaksi'=>'submenu',
            'kelola'=>'submenu',
            'riwayat'=>'',
            'pembayaran'=>'',
            'warga'=>'',
            'admin'=>'',
            'petugas'=>'',
            'kategori'=>'',
            'data_user' => $this->model('User_model')->getUserById($_SESSION['id_admin'])
        ];
        $this->view('templates/headers/HeaderAdminProcess', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view("pages/profile/index", $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_SESSION['id_petugas'];
            if ($type === 'profile') {
                $updateData = [
                    'username' => htmlspecialchars($_POST['username']),
                    'card' => htmlspecialchars($_POST['card']),
                    'name' => htmlspecialchars($_POST['name']),
                    'email' => htmlspecialchars($_POST['email']),
                    'phone' => htmlspecialchars($_POST['phone']),
                    'address' => htmlspecialchars($_POST['address']),
                    'rt' => htmlspecialchars($_POST['rt']),
                ];

                $updateResult = $this->model('User_model')->updateUser(
                    $id,
                    $updateData['username'],
                    $updateData['card'],
                    $updateData['name'],
                    $updateData['email'],
                    $updateData['address'],
                    $updateData['rt'],
                    $updateData['phone'],
                    2
                );

                if ($updateResult) {
                    echo "<script language='javascript'>swal('Selamat...', 'Profil berhasil diperbarui', 'success');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/admin/index">';
                } else {
                    echo "<script language='javascript'>swal('Gagal...', 'Maaf terjadi kesalahan atau error', 'error');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/admin/profile">';
                }
            } elseif ($type === 'password') {
                $newPassword = htmlspecialchars($_POST['new-password']);
                $confirmPassword = htmlspecialchars($_POST['confirm-password']);

                if ($newPassword !== $confirmPassword) {
                    echo "<script language='javascript'>swal('Gagal...', 'Maaf password tidak cocok', 'error');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/officer/profile">';
                } else {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updateResult = $this->model('User_model')->updatePassword($id, $hashedPassword);
                    if ($updateResult) {
                        echo "<script language='javascript'>swal('Selamat...', 'Password berhasil diperbarui', 'success');</script>";
                        echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/admin/index">';
                    } else {
                        echo "<script language='javascript'>swal('Gagal...', 'Maaf terjadi kesalahan atau error', 'error');</script>";
                        echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/admin/profile">';
                    }
                }
            }
        } 
        $this->view('templates/footers/FooterAdminProcess');
    }

    public function updateProfil()
    {
        $this->updateProfileOrPassword('profile');
    }

    public function updatePassword()
    {
        $this->updateProfileOrPassword('password');
    }

    public function about(){
        $data = [
            'title' => 'About Us',
            'file' => 'about',
            'url' => '/admin/index',
            'jenis' => 'admin',
            'dashboard'=>'subdrop',
            'transaksi'=>'submenu',
            'kelola'=>'submenu',
            'riwayat'=>'',
            'pembayaran'=>'',
            'warga'=>'',
            'admin'=>'',
            'petugas'=>'',
            'kategori'=>'',
        ];

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/about');
        $this->view('templates/footers/FooterAdmin');    }
}