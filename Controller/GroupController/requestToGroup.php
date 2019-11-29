<?php
include('../../Model/Config/db_server.php');
session_start();
$db = new DB();
$arrayInfo = array();
$allInfo= array();
$arrayInfo[0] = false;
if(isset($_SESSION['username']))
    if($_SESSION["username"] != null){
        $groupId = $_POST['groupId'];
        $name = $_POST['name'];
        if($groupId == "" || $name == ""){
            echo json_encode(false);
            return;
        }
        $db->query("insert into grouprequest(userID,groupID) values(".$_SESSION["usernameId"].",".$groupId.")");
        $result = $db->query("select 
                            g.id as ID,
                            g.name as name,
                            case
                                when g.id in (select groupID from groupparticipants where userID = ".$_SESSION['usernameId'].") then 1
                                when g.id in (select groupID from grouprequest where userID = ".$_SESSION["usernameId"].") then 2
                                else 0
                                end as isRegistered
                            from groups as g where name like '%".$name."%'");
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