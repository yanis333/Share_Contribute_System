<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
    if($_SESSION["username"]!=null && $_SESSION['isAdmin'] == 1){
        $name = $_POST['name'];
        $result = $db->query("select ID, name,Case When true then 1 end as isRegistered from events where name like '%".$name."%' order by name Asc");
        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[1] = $allInfo;
        }
    }
    else if(isset($_SESSION['username'])){
        $name = $_POST['name'];
        $result = $db->query("select 
                            e.id as ID,
                            e.name as name,
                            case
                                when e.id in (select eventID from eventparticipants where userID = ".$_SESSION['usernameId'].") then 1
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