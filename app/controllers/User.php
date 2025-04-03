<?php

class User extends Controller
{
    private $user;
    private $userId;

    public function __construct()
    {
        // Pastikan pengguna telah login
        if (!isset($_SESSION['login_warga'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }

        // Cache data pengguna untuk menghindari pengambilan data berulang kali
        $this->userId = $_SESSION['id_warga'];
        $this->user = $this->model('Account_model')->getAccountById($this->userId);
    }

    private function loadView($view, $data)
    {
        $this->view('templates/headers/HeaderUser', $data);
        $this->view("$view", $data);
        $this->view('templates/footers/FooterUser');
    }

    public function index()
    {
        $data = [
            'name' => $this->user['full_name'],
            'balance' => $this->user['balance']
        ];
        $this->view("user/index", $data);
    }

    public function sell()
    {
        $data = [
            'title' => 'Tukar',
            'file' => 'sell',
            'url' => '/user/index',
            'categories' => $this->model('Category_model')->getAllCategory()
        ];

        $this->view('templates/headers/HeaderProcess', $data);
        $this->view("user/sell", $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $account = $this->userId;
            $time = $_POST['time'];
            $type = htmlspecialchars($_POST['type']);
            $category = intval($_POST['category']);
            $note = htmlspecialchars($_POST['note']);

            $orderStatus = ($type === 'Langsung') ? 'Selesai' : 'Sedang Diperjalanan';
            $order = $this->model('Pickup_model')->createPickup($account, $time, $type, $orderStatus, $category, $note);

            if ($order > 0) {
                $transactionStatus = ($type === 'Langsung') ? 'Sedang Diproses' : 'Menunggu Penjemputan';
                $this->model('Transaction_model')->CreateTransaction($order, '', 0, $transactionStatus);

                $message = ($type === 'Langsung') ? 'Sampah anda akan diproses admin' : 'Sampah anda akan dijemput petugas';
                echo "<script language='javascript'>swal('Selamat...', '$message', 'success');</script>";
                $redirect = 'history';
            } else {
                echo "<script language='javascript'>swal('Gagal...', 'Maaf Terjadi Error', 'error');</script>";
                $redirect = 'sell';
            }

            echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . "/user/$redirect" . '">';
        }
        $this->view('templates/footers/FooterProcess');
    }

    public function guide()
    {
        $data = [
            'title' => 'Panduan',
            'file' => 'guide',
            'url' => '/user/index',
            'categories' => $this->model('Category_model')->getAllCategory()
        ];

        $this->loadView('/user/guide', $data);
    }

    public function history()
    {
        $data = [
            'title' => 'Riwayat',
            'file' => 'history',
            'url' => '/user/index',
            'account' => $this->userId,
            'transaction' => $this->model('Transaction_model')->getTransactionByAccount($this->userId),
            'pickup' => $this->model('Pickup_model')->getPickupByAccount($this->userId),
            'categories' => $this->model('Category_model')->getAllCategory()
        ];

        $this->loadView('/user/history', $data);
    }

    public function print()
    {
        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data = [
                'data_user' => $this->model('User_model')->getUserById($this->user['user_id']),
                'transactions' => $this->model('Transaction_model')->getTransactionByHashId($id)
            ];
            $this->view('/user/printInvoice', $data);
        } else {
            $this->view('error/error-404');
        }
    }

    public function profile()
    {
        $data = [
            'title' => 'Profil Anda',
            'file' => 'profile',
            'url' => '/user/index',
            'jenis' => 'user',
            'data_user' => $this->model('User_model')->getUserById($this->user['user_id'])
        ];

        $this->loadView('pages/profile/index', $data);
    }

    public function updateProfileOrPassword($type = 'profile')
    {
        $data = [
            'title' => 'Profil Anda',
            'file' => 'profile',
            'url' => '/user/index',
            'jenis' => 'user',
            'data_user' => $this->model('User_model')->getUserById($this->user['user_id'])
        ];
        $this->view('templates/headers/HeaderProcess', $data);
        $this->view("pages/profile/index", $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $this->user['user_id'];
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
                    3
                );

                if ($updateResult) {
                    echo "<script language='javascript'>swal('Selamat...', 'Profil berhasil diperbarui', 'success');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/user/index">';
                } else {
                    echo "<script language='javascript'>swal('Gagal...', 'Maaf terjadi kesalahan atau error', 'error');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/user/profile">';
                }
            } elseif ($type === 'password') {
                $newPassword = htmlspecialchars($_POST['new-password']);
                $confirmPassword = htmlspecialchars($_POST['confirm-password']);

                if ($newPassword !== $confirmPassword) {
                    echo "<script language='javascript'>swal('Gagal...', 'Maaf password tidak cocok', 'error');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/user/profile">';
                } else {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updateResult = $this->model('User_model')->updatePassword($id, $hashedPassword);
                    if ($updateResult) {
                        echo "<script language='javascript'>swal('Selamat...', 'Password berhasil diperbarui', 'success');</script>";
                        echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/user/index">';
                    } else {
                        echo "<script language='javascript'>swal('Gagal...', 'Maaf terjadi kesalahan atau error', 'error');</script>";
                        echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/user/profile">';
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
            'url' => '/user/index'
        ];

        $this->loadView('pages/about/index', $data);
    }
}
