<?php
include('../../Model/Config/db_server.php');
session_start();
$db = new DB();
$arrayInfo = array();
$allInfo= array();

$arrayInfo[0] = false;
if(isset($_SESSION['username']))
    if($_SESSION["username"] != null && $_SESSION['isAdmin'] == 1){
        $name = $_POST['name'];
        $userDOB = $_POST['userDOB'];
        $userEmail = $_POST['email'];
        $userName = $_POST['uName'];
        $userPassword = $_POST['userPassword'];
        $isAdmin = $_POST['isAdmin'];
        if($name == "" || $userDOB == ""|| $userEmail == ""|| $userName == "" || $userPassword == ""){
            echo json_encode(false);
            return;
        }

        $adminRights = 0;
        // Check if isAdmin checked
        if ($isAdmin == 1) {
            $adminRights = 1;
        }
        $stmt = $db->prepare("insert into users(name,password,birth,email,isAdmin,userName) values(?,?,?,?,?,?)");
        $stmt->bind_param("ssssis", $name, $userPassword, $userDOB, $userEmail, $adminRights, $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        $arrayInfo[0] = true;
        $arrayInfo[1] = $name;
    }

echo json_encode($arrayInfo);
?>
