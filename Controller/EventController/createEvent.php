<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
    if(isset($_SESSION['username']))
    if($_SESSION["username"]!=null && $_SESSION['isAdmin'] == 1){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $type = $_POST['type'];

        if($name == "" || $address == ""|| $phone == ""|| $type == ""){
            echo json_encode(false);
            return;
        }
        $result = $db->query("insert into events(name,address,phoneNumber,isActive,typeOfOrg) values('".$name."','".$address."','".$phone."',1,'".$type."')");
      
        if($result){
            $arrayInfo[0] = true;
        }
}
    echo json_encode($arrayInfo);
?>