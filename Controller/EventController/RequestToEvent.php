<?php
    session_start();
    include('../../Model/Config/db_server.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_SESSION['username'])){
            //set variables
            $db = new DB();
            $arrayInfo = array();
            $allInfo= array();
            $arrayInfo[0] = false;
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
                                from events as e where isDeleted=0 and name like '%".$name."%'");
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
    }
    else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        header("Location: ..\..\View\Dashboard\dashboard.php");
    }
?>