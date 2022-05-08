<?php

class Database{
    private $host = 'localhost';
    private $db_name = 'testbank';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect() {
        $this->conn = null;


        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $th) {
            echo 'Connection Error' . $th->getMessage();
        }

        return $this->conn;
    }
}

?>