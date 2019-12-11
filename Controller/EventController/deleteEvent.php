<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = true;
    if($_SESSION["username"]!=null){

        $result = $db->query("Select * from groupparticipants");
        $allInfo = array();
        if($result){
            while($row = $result->fetch_assoc()){
                $stmt = $db->prepare("INSERT INTO accgroup(userID,access,groupID) VALUES(?,1,?)");
                $stmt->bind_param("ii", $row['userID'], $row['groupID']);
                $stmt->execute();
            }
            
        }
    }
    echo json_encode($arrayInfo);
?>