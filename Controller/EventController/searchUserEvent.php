<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
    if(isset($_SESSION['username']))
    if($_SESSION["username"]!=null && $_SESSION['isAdmin'] == 1){

        $result = $db->query("select ID, name,Case When true then 1 end as isRegistered from events where isDeleted=0 order by name Asc");
        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[1] = $allInfo;
        }
    }else{if($_SESSION["username"]!=null){
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
                                    where e.isDeleted=0 and ev.userID = ".$_SESSION["usernameId"]." order by e.name Asc");
            $allInfo = array();

            if($result){
                while($row = $result->fetch_assoc()){
                    $allInfo[] = $row;
                }
                $arrayInfo[0] = true;
                $arrayInfo[1] = $allInfo;
            }
        }

    }
    echo json_encode($arrayInfo);
?>