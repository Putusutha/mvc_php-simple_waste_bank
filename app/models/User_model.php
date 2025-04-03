<?php

class User_model
{
    private $db_main;

    public function __construct()
    {
        $this->db_main = new mysqli(DB_MAIN_HOST, DB_MAIN_USER, DB_MAIN_PASS, DB_MAIN_NAME);
        if ($this->db_main->connect_error) {
            die("Connection failed: " . $this->db_main->connect_error);
        }
    }

    public function findByUsername($username)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Ensure this line is present
    }

    public function getUserById($id)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Ensure this line is present
    }

    public function getUserByHashId($hashId)
    {
        // Prepare and execute the query
        $stmt = $this->db_main->prepare("SELECT * FROM users JOIN roles ON users.role_id = roles.role_id WHERE SHA2(users.user_id, 256) = ?");
        $stmt->bind_param('s', $hashId);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getUsersByNotRole($role){
        $stmt = $this->db_main->prepare("SELECT * FROM users JOIN roles ON users.role_id = roles.role_id WHERE NOT users.role_id = ?");
        $stmt->bind_param("i", $role);
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

    public function getPrintUser($filter, $input)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM users WHERE $filter LIKE '%$input%' AND NOT role_id = 3");
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

    public function countUser()
    {
        $query = "SELECT 
        (SELECT COUNT(user_id) FROM users WHERE role_id = 3) AS count_warga,
        (SELECT COUNT(user_id) FROM users WHERE role_id = 2) AS count_officer
        ";
        $stmt = $this->db_main->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function createUser($username, $hashedPassword, $email, $fullName, $familyCardNumber, $phoneNumber, $roleId, $address, $rt)
    {
        $stmt = $this->db_main->prepare("INSERT INTO users (username, password_hash, email, full_name, family_card_number, phone_number, role_id, address, rt) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiss", $username, $hashedPassword, $email, $fullName, $familyCardNumber, $phoneNumber, $roleId, $address, $rt);
        $result = $stmt->execute();

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function updateUser($id, $username, $familyCardNumber, $fullName, $email, $address, $rt, $phone, $role)
    {
        $stmt = $this->db_main->prepare("UPDATE users SET username = ?, family_card_number = ?, full_name = ?, email = ?, address = ?, rt = ?, phone_number = ?, role_id = ? WHERE user_id = ?");
        $stmt->bind_param("sssssssii", $username, $familyCardNumber, $fullName, $email, $address, $rt, $phone, $role, $id);

        return $stmt->execute();
    }

    public function updatePassword($userId, $hashedPassword)
    {
        $stmt = $this->db_main->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
        $stmt->bind_param("si", $hashedPassword, $userId);
        
        return $stmt->execute();
    }

    public function deleteUser($id)
    {
        // SQL statement to delete category
        $sql = "DELETE FROM users WHERE user_id=?";
        $stmt = $this->db_main->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}
