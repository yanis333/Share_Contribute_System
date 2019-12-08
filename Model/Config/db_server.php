<?php
class DB{
    private $db;
    private $lastId;
    public function __construct()
    {
        $servername = "mrc353.encs.concordia.ca";
        $username = "mrc353_2";
        $password = "D2HN8a";
        $database = "mrc353_2";
        $this->db = mysqli_connect($servername,$username,$password,$database);
        
    }
    public function query($txt){
        $return = $this->db->query($txt);
        $this->lastId = $this->db->insert_id;
       return $return;
    }

    public function prepare($txt){
        return $this->db->prepare($txt);
    }
    public function close(){
        $this->db->close();
    }
    public function getLastInsertedId(){
        return $this->lastId;
    }
}


?>
