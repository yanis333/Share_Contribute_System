<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $allInfo= array();
    $arrayInfo[0] = false;

    if(isset($_SESSION['username']))
    if($_SESSION["username"] != null){

        $name = $_POST['name'];
        $id = $_POST['id'];

        if($name == "" || $id==""){
            echo json_encode(false);
            return;
        }
        $db->query("insert into groups(name,managerID,creationDate,eventID) values('".$name."','".$_SESSION["usernameId"]."','". date('Y-m-d H:i:s')."','".$id."')");
        $result = $db->query("select ID from groups where name=".$name."");
        $arrayInfo[0] = true;
        
    echo json_encode($arrayInfo);
?>