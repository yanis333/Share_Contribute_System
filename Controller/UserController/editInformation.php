<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
    if(isset($_SESSION['username']))
    if($_SESSION["username"]!=null){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        if($firstname == "" || $lastname == ""){
            echo json_encode(false);
            return;
        }
        
        $result = $db->query("Update users set firstname = '".$firstname."' , lastname = '".$lastname."' where username = '".$_SESSION["username"]."'");
      
        if($result){
            $arrayInfo[0] =true;
        }
}
    echo json_encode($arrayInfo);
?>