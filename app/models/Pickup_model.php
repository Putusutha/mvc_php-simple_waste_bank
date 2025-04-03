<?php
class Pickup_model
{
    private $db_main;

    public function __construct()
    {
        $this->db_main = new mysqli(DB_MAIN_HOST, DB_MAIN_USER, DB_MAIN_PASS, DB_MAIN_NAME);
        if ($this->db_main->connect_error) {
            die("Connection failed: " . $this->db_main->connect_error);
        }
    }

    function getAllPickup()
    {
        $sql = "SELECT * FROM pickups";
        $stmt = $this->db_main->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function getRecentPickups()
    {
        $sql = "SELECT * FROM recent_pickups";
        $stmt = $this->db_main->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // Return all results as an array
        return $result->fetch_all(MYSQLI_ASSOC); // Use fetch_all for multiple rows
    }


    public function getPickupByAccount($id)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM pickup_view WHERE account_id = ? AND pickup_type = 'Dijemput'");
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

    public function getPickupByHashId($id)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM pickup_view WHERE SHA2(pickup_id, 256) = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Ambil baris sebagai array asosiatif
        return $result->fetch_assoc();
    }

    public function getPickupByDate($datetime)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM pickup_view WHERE pickup_status = 'Sedang Diperjalanan' AND DATE(pickup_schedule) = ?");
        $stmt->bind_param("s", $datetime);
        $stmt->execute();
        $result = $stmt->get_result();

        // Return all results as an array
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    public function createPickup($account, $time, $type, $status, $category, $note)
    {
        // Prepare the SQL statement
        $stmt = $this->db_main->prepare("INSERT INTO pickups (account, pickup_schedule, pickup_finished, pickup_type, pickup_status, waste_weight, category, waste_condition, pickup_note) VALUES (?, ?, NOW(), ?, ?, '0', ?, '-', ?)");
        // Bind parameters to the SQL statement
        $stmt->bind_param("isssis", $account, $time, $type, $status, $category, $note);

        // Execute the statement
        $stmt->execute();

        // Check if the insertion was successful
        if ($stmt->affected_rows > 0) {
            // Return the last inserted ID
            $lastId = $this->db_main->insert_id;
            return $lastId;
        } else {
            // Return false if insertion failed
            return false;
        }
    }

    public function updatePickup($id, $weight, $category, $condition, $note, $status)
    {
        $stmt = $this->db_main->prepare("UPDATE pickups SET pickup_status=?, waste_weight=?, category=?, waste_condition=?, pickup_note=? WHERE pickup_id = ?");
        $stmt->bind_param("sdissi", $status,$weight, $category, $condition, $note, $id);

        return $stmt->execute();
    }

    public function deletePickup($id)
    {
        $stmt = $this->db_main->prepare("DELETE FROM pickups WHERE pickup_id= ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}
