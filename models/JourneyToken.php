<?php

class JourneyToken {

    private $conn;
    private $used = 1;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getJourneyToken($param) {
        $stmt = $this->conn->prepare('SELECT * FROM `journeytokenlogin` WHERE id=:id AND password=:password');
        $stmt ->bindparam(':id',$param['id']);
        $stmt ->bindparam(':password',$param['password']);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->journeyId = $row['journeyId'];
            $this->inventory = $row['inventory'];
            $this->general1 = $row['general1'];
            $this->general2 = $row['general2'];
                
            return TRUE;
        }

        return FALSE;
    }
    public function setJourneyTokenUsed($param){
        $stmt = $this->conn->prepare('UPDATE `journeytokenlogin` SET used=:used WHERE id=:id AND password=:password');
        $stmt ->bindparam(':used',$this->used);
        $stmt ->bindparam(':id',$param['id']);
        $stmt ->bindparam(':password',$param['password']);
        $stmt->execute();
    }
    public function setJourneyInventory($where,$data){
        $stmt = $this->conn->prepare('SELECT * FROM `journeytokenlogin` WHERE id=:id AND password=:password');
        $stmt ->bindparam(':id',$where['id']);
        $stmt ->bindparam(':password',$where['password']);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            $inventory = json_encode($data['inventory']);
            $stmt = $this->conn->prepare('UPDATE `journeytokenlogin` SET inventory=:inventory WHERE id=:id AND password=:password');
            $stmt ->bindparam(':inventory',$inventory);
            $stmt ->bindparam(':id',$where['id']);
            $stmt ->bindparam(':password',$where['password']);
            $stmt->execute();
            return TRUE;
        }
        return FALSE;
    }
}