<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "" || $password == ""){
        echo json_encode(false);
        return;
    }
    
    $stmt = $db->prepare("Select * from users where username=? AND password=?");
    $stmt->bind_param("si", $username, $password);
    $stmt->execute();
    $row = $result->fetch_assoc();
    $arr = array();
    // if query returns 1 value

    if($row!=null){
    $arr[0] = true;
    $arr[1] = $row['username'];
    $arr[2] = $row['isAdmin'];
    $_SESSION['usernameId'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['isAdmin'] = $row['isAdmin'];
    }
    echo json_encode($arr);
?>