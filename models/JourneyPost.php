<?php

class JourneyPost {

    private $conn;
    private $used = 1;
    private $oldactive = 0;
    private $active = 1;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function getJourneyId($where){
        $stmt = $this->conn->prepare('SELECT * FROM `journeytokenlogin` WHERE id=:id AND password=:password');
        $stmt ->bindparam(':id',$where['id']);
        $stmt ->bindparam(':password',$where['password']);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $journeyTokenLoginId = $row['id'];
            return  $journeyTokenLoginId;
        }else{
            return false;
        }
    }

    public function registerJourneyPost($where,$data){
        $journeyTokenLoginId = $this->getJourneyId($where);
        if($journeyTokenLoginId) {
            $stmt = $this->conn->prepare('UPDATE `journeypostregistration` SET active=:oldactive WHERE journeyTokenLoginId=:journeyTokenLoginId AND password=:password AND active=:active');
            $stmt ->bindparam(':oldactive',$this->oldactive);
            $stmt ->bindparam(':active',$this->active);
            $stmt ->bindparam(':journeyTokenLoginId',$param['journeyTokenLoginId']);
            $stmt->execute();
            
            $stmt = $this->conn->prepare('INSERT INTO  `journeypostregistration`(journeyTokenLoginId,longitude,latitude,result1,reviewComment,pendingReview,navigatorFingerPrintId,checksum,statusId,active) VALUES(:journeyTokenLoginId,:longitude,:latitude,:result1,:reviewComment,:pendingReview,:navigatorFingerPrintId,:checksum,:statusId,:active)');

            $stmt ->bindparam(':journeyTokenLoginId',$journeyTokenLoginId);
            $stmt ->bindparam(':longitude',$data['longitude']);
            $stmt ->bindparam(':latitude',$data['latitude']);
            $stmt ->bindparam(':result1',$data['result1']);
            $stmt ->bindparam(':reviewComment',$data['reviewComment']);
            $stmt ->bindparam(':pendingReview',$data['pendingReview']);
            $stmt ->bindparam(':navigatorFingerPrintId',$data['navigatorFingerPrintId']);
            $stmt ->bindparam(':checksum',$data['checksum']);
            $stmt ->bindparam(':statusId',$data['statusId']);
            $stmt ->bindparam(':active',$this->active);
    
            $stmt->execute();
            return TRUE;
        }
    }
    public function checkJourneyPost($where){
        $journeyTokenLoginId = $this->getJourneyId($where);
        if($journeyTokenLoginId) {
            $stmt = $this->conn->prepare('SELECT * FROM `journeypostregistration` WHERE journeyTokenLoginId=:journeyTokenLoginId AND id=:id');
            $stmt ->bindparam(':journeyTokenLoginId',$journeyTokenLoginId);
            $stmt ->bindparam(':id',$where['jpr_id']);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $this->result1 = $row['result1'];
                    $this->reviewComment = $row['reviewComment'];
                    return TRUE;
                }
                return FALSE;
            }
    }
}