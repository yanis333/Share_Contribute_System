<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
    if($_SESSION["username"]!=null){
        $eventID = $_POST['id'];

        $result = $db->query("update events set isDeleted=1 where id=".$eventID);
        $arrayInfo[0] = true;

     
    }
    echo json_encode($arrayInfo);
?>