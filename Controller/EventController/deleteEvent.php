<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
    if($_SESSION["username"]!=null){
        $eventID = $_POST['id'];

        $result = $db->query("delete 
                            from eventparticipants where eventID=".$eventID."");
        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
        }

        $result = $db->query("delete 
                            from groupparticipants where groupID in (select groupID from groups where eventID=".$eventID.") "); 
                            
        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
        }

        $result = $db->query("delete 
                            from groups where eventID=".$eventID." ");
        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
        }

        $result = $db->query("delete 
                            from postevent where ID in (select postID from posttexttoelement where eventID=".$eventID.") "); 
                            
        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
        }

        $result = $db->query("delete 
                            from commentpostevent where postID in (select postID from posttexttoelement where eventID=".$eventID.") "); 
                            
        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
        }

        $result = $db->query("delete
                            from posttexttoelement where eventID=".$eventID." ");
        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
        }
    }
    echo json_encode($arrayInfo);
?>