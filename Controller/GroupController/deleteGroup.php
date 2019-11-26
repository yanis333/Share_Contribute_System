<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
    if($_SESSION["username"]!=null){
        $groupID = $_POST['id'];

        $result = $db->query("update groups set isDeleted=1 where id=".$groupID);
        $allInfo = array();

        $result = $db->query("select 
                                    e.ID,
                                    e.name,
                                    case
                                    when e.id in (select eventID from eventparticipants where userID = ".$_SESSION["usernameId"].") then 1
                                    when e.id in (select eventID from eventrequest where userID = ".$_SESSION["usernameId"].") then 2
                                    else 0
                                    end as isRegistered
                                    from events as e 
                                    inner join eventparticipants as ev
                                    on ev.eventID = e.ID
                                    where ev.userID = ".$_SESSION["usernameId"]." and e.isdeleted =0 order by e.name Asc");
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