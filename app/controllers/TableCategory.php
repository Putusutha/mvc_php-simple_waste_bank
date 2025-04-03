<?php
class TableCategory  extends Controller
{
    public function index()
    {
        // Pastikan pengguna telah login
        if (!isset($_SESSION['login_admin'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }

        $data['title'] = 'Data Kategori';
        $data['file'] = 'Kategori';
        $data['categories'] = $this->model('Category_model')->getAllCategory();
        $data['kategori'] = 'active';
        $data['dashboard'] = 'subdrop';
        $data['transaksi'] = $data['kelola'] = 'submenu';
        $data['riwayat'] =  $data['pembayaran'] =  $data['warga'] = $data['admin'] =  $data['petugas']  = '';

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/categoryData', $data);
        $this->view('templates/footers/FooterAdmin');
    }

    public function addCategory()
    {
        // Pastikan pengguna telah login
        if (!isset($_SESSION['login_admin'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }

        $data['title'] = 'Data Kategori';
        $data['file'] = 'Kategori';
        $data['kategori'] = 'active';
        $data['dashboard'] = 'subdrop';
        $data['transaksi'] = $data['kelola'] = 'submenu';
        $data['riwayat'] =  $data['pembayaran'] =  $data['warga'] = $data['admin'] =  $data['petugas']  = '';

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/addCategory', $data);
        $this->view('templates/footers/FooterAdmin');
    }

    public function editCategory()
    {
        // Pastikan pengguna telah login
        if (!isset($_SESSION['login_admin'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }

        $data['title'] = 'Data Kategori';
        $data['file'] = 'Kategori';
        $data['kategori'] = 'active';
        $data['dashboard'] = 'subdrop';
        $data['transaksi'] = $data['kelola'] = 'submenu';
        $data['riwayat'] =  $data['pembayaran'] =  $data['warga'] = $data['admin'] =  $data['petugas']  = '';

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data['categories'] = $this->model('Category_model')->getCategoryByHashId($id);
            $this->view('templates/headers/HeaderAdmin', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $this->view('admin/editCategory', $data);
            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('error/error-404');
        }
    }

    public function printCategory()
    {
        // Pastikan pengguna telah login
        if (!isset($_SESSION['login_admin'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }

        $data['title'] = 'Print Data';
        $data['file'] = 'Kategori';
        $data['waktu'] = date('d-m-Y');
        $data['text-header'] = "Daftar Kategori";
        $data['categories'] = $this->model('Category_model')->getAllCategory();

        $this->view('admin/printCategory', $data);
    }

    public function createCategory()
    {
        // Pastikan pengguna telah login
        if (!isset($_SESSION['login_admin'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }

        $data['title'] = 'Data Kategori';
        $data['file'] = 'Kategori';
        $data['kategori'] = 'active';
        $data['dashboard'] = 'subdrop';
        $data['transaksi'] = $data['kelola'] = 'submenu';
        $data['riwayat'] =  $data['pembayaran'] =  $data['warga'] = $data['admin'] =  $data['petugas']  = '';

        $this->view('templates/headers/HeaderAdmin', $data);
        $this->view('templates/sidebar/sidebarAdmin', $data);
        $this->view('admin/addCategory', $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlspecialchars($_POST['name']);
            $price = $_POST['price'];
            $image = $_FILES['file'];
            $result = $this->model('Category_model')->createCategory($name, $price, $image);

            if ($result == 'Data baru berhasil ditambahkan') {
                // echo $result.$_FILES['file'];
                echo "<script language='javascript'>swal('Selamat...', '$result', 'success');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableCategory/index">';
            } else {
                // echo $result.$_FILES['file'];
                echo "<script language='javascript'>swal('Gagal...', '$result', 'error');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableCategory/addCategory">';
            }
        }
        $this->view('templates/footers/FooterAdmin');
    }

    public function updateCategory()
    {
        // Pastikan pengguna telah login
        if (!isset($_SESSION['login_admin'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data['title'] = 'Data Kategori';
            $data['file'] = 'Kategori';
            $data['kategori'] = 'active';
            $data['dashboard'] = 'subdrop';
            $data['transaksi'] = $data['kelola'] = 'submenu';
            $data['riwayat'] =  $data['pembayaran'] =  $data['warga'] = $data['admin'] =  $data['petugas']  = '';

            $this->view('templates/headers/HeaderAdmin', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $data['categories'] = $this->model('Category_model')->getCategoryByHashId($id);
            $this->view('admin/editCategory', $data);

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = htmlspecialchars($_POST['name']);
                $price = $_POST['price'];
                $image = $_FILES['file'];
                $dataCategory = $data['categories'];
                $lastImage = $dataCategory['category_image'];
                $categoryId = $dataCategory['category_id'];

                $result = $this->model('Category_model')->updateCategory($name, $price, $image, $lastImage, $categoryId);

                if ($result == 'Data berhasil diperbarui') {
                    echo "<script language='javascript'>swal('Selamat...', '$result', 'success');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableCategory/index">';
                } else {
                    echo "<script language='javascript'>swal('Gagal...', '$result', 'error');</script>";
                    echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/tableCategory/editCategory">';
                }
            }
            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('error/error-404');
        }
    }

    public function deleteCategory()
    {
        // Pastikan pengguna telah login
        if (!isset($_SESSION['login_admin'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit();
        }

        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data['title'] = 'Data Kategori';
            $data['file'] = 'Kategori';
            $data['kategori'] = 'active';
            $data['dashboard'] = 'subdrop';
            $data['transaksi'] = $data['kelola'] = 'submenu';
            $data['riwayat'] =  $data['pembayaran'] =  $data['warga'] = $data['admin'] =  $data['petugas']  = '';
            $data['categories'] = $this->model('Category_model')->getAllCategory();

            $this->view('templates/headers/HeaderAdmin', $data);
            $this->view('templates/sidebar/sidebarAdmin', $data);
            $this->view('admin/categoryData', $data);
            $category = $this->model('Category_model')->getCategoryByHashId($id);
            $delete = $this->model('Category_model')->deleteCategory($category['category_id'], $category['category_image']);

            if ($delete) {
                echo "<script language='javascript'>swal('Selamat...', 'Data berhasil dihapus', 'success');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableCategory/index">';
            } else {
                echo "<script language='javascript'>swal('Gagal...', 'Maaf, ada sedikit kesalahan', 'error');</script>";
                echo '<meta http-equiv="refresh" content="3; url=' . BASEURL . '/TableCategory/index">';
            }

            $this->view('templates/footers/FooterAdmin');
        } else {
            $this->view('error/error-404');
        }
    }
}
