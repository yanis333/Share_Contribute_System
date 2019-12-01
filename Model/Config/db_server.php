<?php
class DB{
    private $db;
    private $lastId;
    public function __construct()
    {
        $servername = "us-cdbr-iron-east-05.cleardb.net:3306";
        $username = "b9fb0372682c82";
        $password = "f3d42555";
        $database = "heroku_99595f089932bf8";
        $this->db = mysqli_connect($servername,$username,$password,$database);
        
    }
    public function query($txt){
        $return = $this->db->query($txt);
        $this->lastId = $this->db->insert_id;
       return $return;
    }

    public function prepare($txt){
        return $this->prepare($txt);
    }
    public function close(){
        $this->db->close();
    }
    public function getLastInsertedId(){
        return $this->lastId;
    }
}


?>

create table eventpaid(
    id int primary key,
    userID int not null,
    eventID int not null,
    amount nvarchar(10),
    date datetime default CURRENT_TIMESTAMP
);
alter table eventpaid add constraint fk_eventpaid_userID FOREIGN KEY(userID)
references users(id);
alter table eventpaid add constraint fk_eventpaid_eventID FOREIGN KEY(eventID)
references events(ID);