<?php

class Database {
    // private $host = "localhost";
    private $host = "turskattonline01.mysql.domeneshop.no";
    
    private $db = "turskattonline01";
    // private $user = "root";
    private $user = "turskattonline01";
    // private $pwd = "";
    private $pwd = "ball-Egget-meie-0jet";
    private $conn = NULL;

    public function connect() {
        try{
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pwd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exp) {
            echo "Connection Error: " . $e->getMessage();
        }

        return $this->conn;
    }
}