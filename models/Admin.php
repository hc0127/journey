<?php

class Admin {

    private $conn;
    private $active = 1;
    private $disabled = 0;
    private $status = 1;

    public function __construct($db){
        $this->conn = $db;
    }

    public function checkAdmin($param) {
        $stmt = $this->conn->prepare('SELECT * FROM `administrator` WHERE username=:username AND password=:password AND active=:active');
        $stmt ->bindparam(':username',$param['username']);
        $stmt ->bindparam(':password',$param['password']);
        $stmt ->bindparam(':active',$this->active);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function getJourneyPosts($param){
        if($this->checkAdmin($param)){
            $stmt = $this->conn->prepare('SELECT id,statusId,result1,reviewComment FROM `journeypostregistration` WHERE disabled=:disabled');
            $stmt ->bindparam(':disabled',$this->disabled);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                $this->posts = $rows;
                return true;
            }
        }else{
            return false;
        }
    }

    public function modifyJourneyPosts($param,$data){
        if($this->checkAdmin($param)){
            $stmt = $this->conn->prepare('UPDATE `journeypostregistration` SET result1=:result1, reviewComment=:reviewComment, statusId=:statusId WHERE id=:id');
            $stmt ->bindparam(':result1',$data['result1']);
            $stmt ->bindparam(':reviewComment',$data['reviewComment']);
            $stmt ->bindparam(':statusId',$this->status);
            $stmt ->bindparam(':id',$param['jpr_id']);
            $stmt->execute();
            return true;
        }else{
            return false;
        }
    }
}