<?php
class Transaction_model
{
    private $db_main;

    public function __construct()
    {
        $this->db_main = new mysqli(DB_MAIN_HOST, DB_MAIN_USER, DB_MAIN_PASS, DB_MAIN_NAME);
        if ($this->db_main->connect_error) {
            die("Connection failed: " . $this->db_main->connect_error);
        }
    }

    function getAllTransaction($status)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM transaction_view WHERE transaction_status ='$status' ORDER BY transaction_id");
        $stmt->execute();
        $result = $stmt->get_result();

        // Ambil hasil query dan masukkan ke dalam array
        if ($result) {
            $pickups = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close(); // Tutup statement setelah digunakan
            return $pickups;
        } else {
            return []; // Jika tidak ada hasil, kembalikan array kosong
        }
    }

    function getPrintTransaction($filter, $input, $status)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM transaction_view WHERE $filter LIKE '%$input%' AND transaction_status = '$status' ORDER BY transaction_id");
        $stmt->execute();
        $result = $stmt->get_result();

        // Ambil hasil query dan masukkan ke dalam array
        if ($result) {
            $pickups = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close(); // Tutup statement setelah digunakan
            return $pickups;
        } else {
            return []; // Jika tidak ada hasil, kembalikan array kosong
        }
    }

    function getHistoryPrintTransaction($filter, $input, $status)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM transaction_view WHERE $filter LIKE '%$input%' AND NOT transaction_status = '$status' ORDER BY transaction_id");
        $stmt->execute();
        $result = $stmt->get_result();

        // Ambil hasil query dan masukkan ke dalam array
        if ($result) {
            $pickups = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close(); // Tutup statement setelah digunakan
            return $pickups;
        } else {
            return []; // Jika tidak ada hasil, kembalikan array kosong
        }
    }

    function getHistoryTransaction()
    {
        $stmt = $this->db_main->prepare("SELECT * FROM transaction_view WHERE NOT transaction_status = 'Sedang Diproses' ORDER BY transaction_id");
        $stmt->execute();
        $result = $stmt->get_result();

        // Ambil hasil query dan masukkan ke dalam array
        if ($result) {
            $pickups = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close(); // Tutup statement setelah digunakan
            return $pickups;
        } else {
            return []; // Jika tidak ada hasil, kembalikan array kosong
        }
    }

    public function getTransactionByAccount($id)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM transaction_view WHERE account_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Ambil hasil query dan masukkan ke dalam array
        if ($result) {
            $pickups = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close(); // Tutup statement setelah digunakan
            return $pickups;
        } else {
            return []; // Jika tidak ada hasil, kembalikan array kosong
        }
    }

    public function getTransactionByHashId($hashId)
    {
        // Prepare and execute the query
        $stmt = $this->db_main->prepare("SELECT * FROM transaction_view WHERE SHA2(transaction_id, 256) = ?");
        $stmt->bind_param('s', $hashId);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


    public function countTransaction()
    {
        $date = date('Y-m-d');
        $query = "SELECT 
                    (SELECT COUNT(transaction_id) FROM transactions WHERE transaction_status = 'Selesai' AND DATE(transaction_date) = ?) AS count_trans,
                    (SELECT COUNT(transaction_id) FROM transaction_view WHERE transaction_status = 'Sedang Diproses' AND DATE(pickup_finished) = ?) AS count_proses
                ";

        // Prepare and execute the statement
        if ($stmt = $this->db_main->prepare($query)) {
            $stmt->bind_param('ss', $date, $date);
            $stmt->execute();
            $result = $stmt->get_result();

            // Fetch the result
            $data = $result->fetch_assoc();

            // Close the statement
            $stmt->close();

            return $data;
        } else {
            // Handle errors
            throw new Exception('Database prepare failed: ' . $this->db_main->error);
        }
    }


    public function CreateTransaction($pickup, $date, $amount, $status)
    {
        // Prepare the SQL statement
        $stmt = $this->db_main->prepare("INSERT INTO transactions (pickup, transaction_date, amount, transaction_status) VALUES (?, ?, ?, ?)");

        // Bind parameters to the SQL statement
        $stmt->bind_param("isds", $pickup, $date, $amount, $status);

        // Execute the statement
        $stmt->execute();

        // Check if the insertion was successful
        if ($stmt->affected_rows > 0) {
            // Return the last inserted ID
            return true;
        } else {
            // Return false if insertion failed
            return false;
        }
    }

    public function updateTransaction($id, $amount, $status, $desc)
    {
        $stmt = $this->db_main->prepare("UPDATE transactions SET transaction_date= NOW(), amount=?, transaction_status=?, transaction_information=? WHERE SHA2(transaction_id, 256) = ?");
        $stmt->bind_param("dsss", $amount, $status, $desc, $id);

        return $stmt->execute();
    }

    public function deleteTransaction($id)
    {
        $stmt = $this->db_main->prepare("DELETE FROM transactions WHERE SHA2(transaction_id, 256) = ?");
        $stmt->bind_param("s", $id);

        return $stmt->execute();
    }
}
