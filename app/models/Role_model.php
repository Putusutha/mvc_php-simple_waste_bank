<?php

class Role_model
{
    private $db_main;

    public function __construct()
    {
        $this->db_main = new mysqli(DB_MAIN_HOST, DB_MAIN_USER, DB_MAIN_PASS, DB_MAIN_NAME);
        if ($this->db_main->connect_error) {
            die("Connection failed: " . $this->db_main->connect_error);
        }
    }

    public function getRoleById($id)
    {
        $stmt = $this->db_main->prepare("SELECT * FROM roles WHERE role_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the row as an associative array
        return $result->fetch_assoc();
    }

}
