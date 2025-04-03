<?php
class Category_model
{
    private $db_main;

    public function __construct()
    {
        $this->db_main = new mysqli(DB_MAIN_HOST, DB_MAIN_USER, DB_MAIN_PASS, DB_MAIN_NAME);
        if ($this->db_main->connect_error) {
            die("Connection failed: " . $this->db_main->connect_error);
        }
    }

    function getAllCategory()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->db_main->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // Ambil hasil query dan masukkan ke dalam array
        if ($result) {
            $categories = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close(); // Tutup statement setelah digunakan
            return $categories;
        } else {
            return []; // Jika tidak ada hasil, kembalikan array kosong
        }
    }

    public function getCategoryById($id)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getCategoryByHashId($hashId)
    {
        // Prepare and execute the query
        $stmt = $this->db_main->prepare("SELECT * FROM categories WHERE SHA2(category_id, 256) = ?");
        $stmt->bind_param('s', $hashId);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createCategory($name, $price, $image)
    {
        if ($image['error'] === UPLOAD_ERR_OK) {
            // Path lokal ke folder uploads
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/waste-bank-app/public/uploads/";
            $fileName = basename($image['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Periksa jenis file
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                // Unggah file ke server
                if (move_uploaded_file($image["tmp_name"], $targetFilePath)) {
                    $sql = "INSERT INTO categories (category_name, category_price, category_image) VALUES (?, ?, ?)";
                    $stmt = $this->db_main->prepare($sql);
                    $stmt->bind_param("sds", $name, $price, $fileName);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        return 'Data baru berhasil ditambahkan';
                    } else {
                        return 'Maaf, terjadi sedikit error dan kesalahan';
                    }
                } else {
                    return "Maaf, terjadi kesalahan saat mengunggah file.";
                }
            } else {
                return "Maaf, hanya file JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            }
        } else {
            return "Maaf, ada masalah dengan unggahan gambar.";
        }
    }

    public function updateCategory($name, $price, $image, $lastImage, $id)
    {
        // Path lokal ke folder uploads
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/waste-bank-app/public/uploads/";
    
        // Check if an image is provided
        if (!empty($image['name'])) {
            $fileName = basename($image['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
            // Periksa jenis file
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                // Unggah file ke server
                if (move_uploaded_file($image["tmp_name"], $targetFilePath)) {
                    // Prepare the SQL statement to update the database
                    $sql = "UPDATE categories SET category_name = ?, category_price = ?, category_image = ? WHERE category_id = ?";
                    $stmt = $this->db_main->prepare($sql);
                    $stmt->bind_param("sdsi", $name, $price, $fileName, $id);
                    $stmt->execute();
    
                    if ($stmt->affected_rows > 0) {
                        // Delete the old image if it exists
                        if (!empty($lastImage)) {
                            $oldImagePath = $targetDir . $lastImage;
                            if (file_exists($oldImagePath)) {
                                unlink($oldImagePath);
                            }
                        }
                        return "Data berhasil diperbarui";                 
                    } else {
                        return "Maaf, ada kesalahan data saat diubah";                  
                    }
                } else {
                    return "Maaf, terjadi kesalahan saat mengunggah file.";
                }
            } else {
                return "Maaf, hanya file JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            }
        } else {
            // Update only name and price if no new image is provided
            $sql = "UPDATE categories SET category_name = ?, category_price = ? WHERE category_id = ?";
            $stmt = $this->db_main->prepare($sql);
            $stmt->bind_param("sdi", $name, $price, $id);
            $stmt->execute();
    
            if ($stmt->execute()) {
                return 'Data berhasil diperbarui';
            } else {
                return 'Maaf, terjadi sedikit error dan kesalahan';
            }
        }
    }    

    public function deleteCategory($id, $image)
    {
        // Path lokal ke folder uploads
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/waste-bank-app/public/uploads/";
        $fullImagePath = $targetDir . $image;
    
        // SQL statement to delete category
        $sql = "DELETE FROM categories WHERE category_id=?";
        $stmt = $this->db_main->prepare($sql);
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            // Delete image file if exists and not default
            if (file_exists($fullImagePath)) {
                if (unlink($fullImagePath)) {
                    return true; // Return true if deletion successful
                } else {
                    error_log("Failed to delete file: " . $fullImagePath);
                    return false; // Return false if file deletion fails
                }
            } else {
                error_log("File not found: " . $fullImagePath);
                return true; // Return true if file does not exist
            }
        } else {
            return false; // Return false if SQL deletion fails
        }
    }    
}
