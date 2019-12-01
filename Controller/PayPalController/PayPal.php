<?php

include('../../Model/Config/db_server.php');
class PayPal{
    private $db;
    public function __construct()
    {   
        $this->db = new DB(); 
    }

    public function __destruct(){
        $this->close($this->db);
    }

    public function didUserPay($userID, $eventID){
        $stmt = $this->db->prepare("select * from eventpaid where userID=? AND eventID=?");
        $stmt->bind_param("ii", $userID, $eventID);
        $result = $stmt->execute();
        
        $value;
        if($result)
            $value = true;
        else
            $value = false;
        $this->close($stmt);
        return $value;
        
    }

    public function insertPaidEvent($userID, $eventID, $amount){
        $stmt = $db->prepare("insert into eventpaid(userID, eventID, amount) values('?','?','?')");
        $stmt->bind_param("iid", $userID, $eventID, $amount);
        $result = $stmt->execute();
        $this->close($stmt);

        return $result;
    }

    public function getPaidEventHistory($userID){
        $stmt = $this->db->prepare("select * from eventpaid where userID=?");
        $stmt->bind_param("i", $userID);
        $result = $stmt->execute();
        $this->close($stmt);

        return $result;
    
    }

    public function getEventPrice($eventID){

    }

    private function close($obj){
        $this->db->close();
    }
}
?>