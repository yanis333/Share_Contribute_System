<?php
class DB{
    private $db;
    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "comp_353";
        $this->db = mysqli_connect($servername,$username,$password,$database);
        
    }
    public function query($txt){
       return $this->db->query($txt);
    }
    public function close(){
        $this->db->close();
    }
}


?>