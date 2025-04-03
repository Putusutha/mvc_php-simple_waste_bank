<?php
class Officer extends Controller
{
    private function isAuthenticated()
    {
        if (!isset($_SESSION['login_petugas'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }
    }

    private function loadView($view, $data = [])
    {
        $this->view('templates/headers/HeaderUser', $data);
        $this->view($view, $data);
        $this->view('templates/footers/FooterUser');
    }

    public function index()
    {
        $this->isAuthenticated();
        $this->view('officer/index');
    }

    public function guide()
    {
        $this->isAuthenticated();
        $data = [
            'title' => 'Panduan Pengguna',
            'file' => 'guide',
            'url' => '/officer/index',
            'categories' => $this->model('Category_model')->getAllCategory()
        ];
        $this->loadView('officer/guide', $data);
    }

    public function pickup()
    {
        $this->isAuthenticated();
        $datetime = $_POST['datetime'] ?? date('Y-m-d');

        $data = [
            'title' => 'Penjemputan',
            'file' => 'pickup',
            'url' => '/officer/index',
            'pickup' => $this->model('Pickup_model')->getPickupByDate($datetime)
        ];
        $this->loadView('officer/pickup', $data);
    }

    public function profile()
    {
        $this->isAuthenticated();
        $data = [
            'title' => 'Profil Anda',
            'file' => 'profile',
            'url' => '/officer/index',
            'jenis' => 'officer',
            'data_user' => $this->model('User_model')->getUserById($_SESSION['id_petugas'])
        ];
        $this->loadView('pages/profile/index', $data);
    }

    public function confirmPickup()
    {
        $this->isAuthenticated();
        if (!isset($_GET['data'])) {
            $this->view('error/error-404');
            return;
        }

        $id = $_GET['data'];
        $data = [
            'title' => 'Konfirmasi',
            'file' => 'confirmPickup',
            'url' => '/officer/pickup   ',
            'pickup' => $this->model('Pickup_model')->getPickupByHashId($id),
            'categories' => $this->model('Category_model')->getAllCategory()
        ];
        $this->loadView('officer/confirmPickup', $data);
    }

    public function updatePickup()
    {
        $this->isAuthenticated();
        if (!isset($_GET['data'])) {
            $this->view('error/error-404');
            return;
        }

        $id = $_GET['data'];
        $data = [
            'title' => 'Konfirmasi',
            'file' => 'confirmPickup',
            'url' => '/officer/index',
            'pickup' => $this->model('Pickup_model')->getPickupByHashId($id),
            'categories' => $this->model('Category_model')->getAllCategory()
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->view('templates/headers/HeaderProcess', $data);
            $this->view('officer/confirmPickup', $data);
            $category = intval($_POST['category']);
            $weight = $_POST['weight'];
            $condition = $_POST['condition'];
            $status = $_POST['status'];
            $note = htmlspecialchars($_POST['note']);
            $pickup = $data['pickup'];


            $amount = doubleval($pickup['category_price']) * $weight;
            $success = $this->model('Pickup_model')->updatePickup($pickup['pickup_id'], $weight, $category, $condition, $note, $status);


            $success = false;

            if ($status == 'Selesai') {
                $success = $this->model('Pickup_model')->updatePickup($pickup['pickup_id'], $weight, $category, $condition, $note, $status) &&
                           $this->model('Transaction_model')->CreateTransaction($pickup['pickup_id'], NULL, $amount, 'Sedang Diproses');
            } elseif ($status == 'Dibatalkan') {
                $success = $this->model('Pickup_model')->updatePickup($pickup['pickup_id'], 0, $category, $condition, $note, $status);
            } else {
                $success = $this->model('Pickup_model')->updatePickup($pickup['pickup_id'], $weight, $category, $condition, $note, $status);
            }

            $caption = $success ? 'Selamat...' : 'Gagal...';
            $message = $success ? 'Konfirmasi Berhasil' : 'Maaf, ada kesalahan';
            $alertType = $success ? 'success' : 'error';
            $redirectUrl = $success ? BASEURL . '/officer/index' : BASEURL . '/officer/confirmPickup';
            
            echo "<script language='javascript'>swal('{$caption}', '{$message}', '{$alertType}');</script>";
            echo '<meta http-equiv="refresh" content="3; url=' . $redirectUrl . '">';
            $this->view('templates/footers/FooterProcess');
        }else{
            $this->loadView('officer/confirmPickup', $data);
        }
    }

    public function updateProfileOrPassword($type = 'profile')
    {
        $data = [
            'title' => 'Profil Anda',
            'file' => 'profile',
            'url' => '/officer/index',
            'jenis' => 'officer',
            'data_user' => $this->model('User_model')->getUserById($_SESSION['id_petugas'])
        ];
        $this->view('templates/headers/HeaderProcess', $data);
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
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/officer/index">';
                } else {
                    echo "<script language='javascript'>swal('Gagal...', 'Maaf terjadi kesalahan atau error', 'error');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/officer/profile">';
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
                        echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/officer/index">';
                    } else {
                        echo "<script language='javascript'>swal('Gagal...', 'Maaf terjadi kesalahan atau error', 'error');</script>";
                        echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/officer/profile">';
                    }
                }
            }
        } 
        $this->view('templates/footers/FooterProcess');
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
            'url' => '/officer/index'
        ];
        $this->loadView('pages/about/index', $data);
    }
}
