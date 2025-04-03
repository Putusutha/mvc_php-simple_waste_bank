<?php

class Account_model
{
    private $db_main;

    public function __construct()
    {
        $this->db_main = new mysqli(DB_MAIN_HOST, DB_MAIN_USER, DB_MAIN_PASS, DB_MAIN_NAME);
        if ($this->db_main->connect_error) {
            die("Connection failed: " . $this->db_main->connect_error);
        }
    }

    public function getAccountByUsername($username)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM accounts JOIN users ON accounts.user_id = users.user_id WHERE users.username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Ambil baris sebagai array asosiatif
        return $result->fetch_assoc();
    }

    public function getAccountById($id)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM accounts JOIN users ON accounts.user_id = users.user_id WHERE account_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Ambil baris sebagai array asosiatif
        return $result->fetch_assoc();
    }

    public function getAccountByHashId($id)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM user_account_roles WHERE SHA2(account_id, 256) = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Ambil baris sebagai array asosiatif
        return $result->fetch_assoc();
    }

    public function getPrintAccount($filter, $input)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM user_account_roles WHERE $filter LIKE '%$input%'");
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

    public function getAccountsByRole($id)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM user_account_roles WHERE role_id = ?");
        $stmt->bind_param("i", $id);
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

    public function getAccountsByNotRoleWarga($id)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM user_account_roles WHERE NOT role_id = ?");
        $stmt->bind_param("i", $id);
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

    public function createAccount($username, $hashedPassword, $email, $fullName, $familyCardNumber, $phoneNumber, $roleId, $address, $rt)
    {
        // Siapkan statement untuk menambahkan data ke tabel users
        $stmt = $this->db_main->prepare("INSERT INTO users (username, password_hash, email, full_name, family_card_number, phone_number, role_id, address, rt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiss", $username, $hashedPassword, $email, $fullName, $familyCardNumber, $phoneNumber, $roleId, $address, $rt);
        $result = $stmt->execute();

        if ($result) {
            // Ambil user_id dari entri yang baru ditambahkan
            $userId = $this->db_main->insert_id;

            // Siapkan statement untuk menambahkan data ke tabel accounts
            $stmt = $this->db_main->prepare("INSERT INTO accounts (user_id, balance)VALUES (?, 0)");
            $stmt->bind_param("i", $userId);
            $result = $stmt->execute();

            if ($result) {
                return true; // Kembalikan user_id jika berhasil
            } else {
                return false; // Gagal menambahkan data ke tabel accounts
            }
        } else {
            return false; // Gagal menambahkan data ke tabel users
        }
    }

    public function updateBalance($id, $balance)
    {
        $stmt = $this->db_main->prepare("UPDATE accounts SET balance = ? WHERE SHA2(account_id, 256) = ?");
        $stmt->bind_param("ds", $balance, $id);

        return $stmt->execute();
    }

    public function addBalance($id, $balance)
    {
        $stmt = $this->db_main->prepare("UPDATE accounts SET balance = ? WHERE account_id = ?");
        $stmt->bind_param("di", $balance, $id);

        return $stmt->execute();
    }

    public function deleteAccount($id)
    {
        $stmt = $this->db_main->prepare("DELETE FROM accounts WHERE SHA2(account_id, 256) = ?");
        $stmt->bind_param("s", $id);

        return $stmt->execute();
    }
}
