<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $allInfo= array();
    $arrayInfo[0] = false;
    if(isset($_SESSION['username']))
    if($_SESSION["username"] != null){
        $eventId = $_POST['eventId'];

        $stmt = $db->prepare("update events set isActive = 0 where ID=?");
        $stmt->bind_param("i", $eventId);
        $stmt->execute();

        $stmt = $db->prepare("select isActive from events where ID=?");
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $result = $stmt->get_result();

        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[1] = $allInfo;
        }
    }
    echo json_encode($arrayInfo);
?>