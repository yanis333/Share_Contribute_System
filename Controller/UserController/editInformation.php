<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
    if(isset($_SESSION['username']))
    if($_SESSION["username"]!=null){
        $name = $_POST['name'];

        if($name == ""){
            echo json_encode(false);
            return;
        }
        
        $stmt = $db->prepare("Update users set name = ? where username = ?");
        $stmt->bind_param("ss", $name, $_SESSION["username"]);
        $stmt->execute();
        $result = $stmt->get_result();
      
        if($result){
            $arrayInfo[0] =true;
        }
}
    echo json_encode($arrayInfo);
?>