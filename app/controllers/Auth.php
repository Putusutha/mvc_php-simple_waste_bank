<?php

class Auth extends Controller {
    public function login() {
        $data['file'] = 'login';
        $data['title'] = 'Login';
        $this->view('templates/headers/HeaderAuth', $data);
        $this->view('auth/login');
        $this->view('templates/footers/FooterAuth');
    }    

    public function register() {
        $this->view('auth/register');
    }

    public function forgetpassword() {
        $this->view('auth/forgetpassword');
    }

    public function authenticate() {
        $data['file'] = 'login';
        $data['title'] = 'Login';
        $this->view('templates/headers/HeaderAuth', $data);
        $this->view('auth/login');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            $user = $this->model('User_model')->findByUsername($username);

            if($user != NULL){

                if(password_verify($password, $user['password_hash'])){
                    $role = $this->model('Role_model')->getRoleById($user['role_id']);
                    $account = $this->model('Account_model')->getAccountByUsername($username);
                    $user = $this->model('User_model')->findByUsername($username);

                    switch ($role['role_name']) {

                        case "Admin":
                            $_SESSION['id_admin'] = $user['user_id'];
                            $_SESSION['status'] = 'login';
                            $_SESSION['login_admin'] = true;
                            $_SESSION['name'] = $user['full_name'];
                            $role = 'admin';
                            echo "<script language='javascript'>swal('Selamat...', 'Login Berhasil sebagai Admin!', 'success');</script>";
                            break;

                        case "Petugas":
                            $_SESSION['id_petugas'] = $user['user_id'];
                            $_SESSION['status'] = 'login';
                            $_SESSION['login_petugas'] = true;
                            $role = 'officer';
                            echo "<script language='javascript'>swal('Selamat...', 'Login Berhasil sebagai Petugas!', 'success');</script>";
                            break;

                        default:
                            $_SESSION['id_warga'] = $account['user_id'];
                            $_SESSION['status'] = 'login';
                            $_SESSION['login_warga'] = true;
                            $role = 'user';
                            echo "<script language='javascript'>swal('Selamat...', 'Login Berhasil sebagai Warga!', 'success');</script>";
                            break;  
                    }
                    echo '<meta http-equiv="refresh" content="3; url='.BASEURL.'/'.$role.'/index">';
                }else{
                    echo "<script language='javascript'>swal('Gagal...', 'Password Anda Salah', 'error');</script>";
                    echo '<meta http-equiv="refresh" content="3; url='.BASEURL.'/auth/login">';
                }

            }else{
                echo "<script language='javascript'>swal('Gagal...', 'Username Tidak Ditemukan', 'error');</script>";
                echo '<meta http-equiv="refresh" content="3; url='.BASEURL.'/auth/login">';
            }

        } 
        $this->view('templates/footers/FooterAuth');
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        header("location: ".BASEURL."/auth/login");
        exit;
    }
}
