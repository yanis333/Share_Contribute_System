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
        if($groupId == ""){
            echo json_encode(false);
            return;
        }

        $db->query("insert into grouprequest(userID,groupID) values(".$_SESSION["usernameId"].",".$groupId.")");

        $result = $db->query("select 
                                    g.name,
                                    g.ID,
                                    e.name as eventName,
                                    case
                                    when g.ID in (select groupID from groupparticipants where userID = ".$_SESSION['usernameId'].") then 1
                                    when g.ID in (select groupID from grouprequest where userID = ".$_SESSION["usernameId"].") then 2
                                    else 0
                                    end as isRegistered
                                    from groups as g 
                                    left join events as e on e.ID=g.eventID
                                    where g.isDeleted=0 and e.isDeleted=0 and g.id in (select gp.groupID from groupparticipants as gp where gp.userID =".$_SESSION['usernameId']." and g.name like '%".$name."%' order by g.name Asc)");
        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[1] = $allInfo;
            $arrayInfo[2] = "manne";
        }

        $result = $db->query("select g.ID,g.name,e.name as eventName,
                                    case
                                    when g.ID in (select groupID from groupparticipants where userID = ".$_SESSION['usernameId'].") then 1
                                    when g.ID in (select groupID from grouprequest where userID = ".$_SESSION["usernameId"].") then 2
                                    else 0
                                    end as isRegistered
                                     from groups as g 
                                     left join events as e on e.ID = g.eventID
                                     where g.isDeleted=0 and e.isDeleted=0 and eventID in 
                                     (select e.Id 
                                        from eventparticipants as ep 
                                        inner join events as e on e.Id = ep.eventID 
                                        where e.isDeleted=0 and ep.userid=".$_SESSION['usernameId'].")  AND NOT g.ID in 
                                        (select gp2.groupID 
                                            from groupparticipants as gp2 
                                                   where gp2.userID) AND  g.name like '%".$name."%' order by g.name Asc");

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[1] = $allInfo;
        }


    }
echo json_encode($arrayInfo);