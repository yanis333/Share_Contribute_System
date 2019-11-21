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
        $name = $_POST['name'];

        if($eventId == "" || $name == ""){
            echo json_encode(false);
            return;
        }
        $db->query("insert into eventrequest(userID,eventID) values(".$_SESSION["usernameId"].",".$eventId.")");

        $result = $db->query("select 
                            e.id as ID,
                            e.name as name,
                            case
                                when e.id in (select eventID from eventparticipants where userID = ".$_SESSION['usernameId'].") then 1
                                when e.id in (select eventID from eventrequest where userID = ".$_SESSION["usernameId"].") then 2
                                else 0
                                end as isRegistered
                            from events as e where name like '%".$name."%'");
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