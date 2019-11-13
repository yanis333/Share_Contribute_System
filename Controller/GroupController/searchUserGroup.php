<?php
     include('../../Model/Config/db_server.php');
     session_start();
     $db = new DB();
     $arrayInfo = array();
     $arrayInfo[0] = false;
     if(isset($_SESSION['username'])){

        if($_SESSION["username"]!=null && $_SESSION['isAdmin'] == 1){

            $result = $db->query("select g.id,g.name,e.name as eventName from groups as g left join events as e on e.ID=g.eventID");
                
            $allInfo = array();
    
            if($result){
                while($row = $result->fetch_assoc()){
                    $allInfo[] = $row;
                }
                $arrayInfo[0] = true;
                $arrayInfo[1] = $allInfo;
            }

            }else if($_SESSION["username"]!=null) {

            $result = $db->query("select 
                                    g.name,
                                    g.managerID,
                                    g.creationDate,
                                    g.eventID,
                                    e.name as eventName
                                    from groups as g 
                                    left join events as e on e.ID=g.eventID
                                    where g.id in (select gp.groupID from groupparticipants as gp where gp.userID =11)");
            $allInfo = array();

            if($result){
                while($row = $result->fetch_assoc()){
                    $allInfo[] = $row;
                }
                $arrayInfo[0] = true;
                $arrayInfo[1] = $allInfo;
            }

            $result = $db->query("select g.ID,g.name,e.name as eventName,Case When true then 0 end as isRegistered 
            from groups as g 
            left join groupparticipants as gp on gp.groupID = g.id 
            left join events as e on e.ID = g.eventID
            where eventID in 
                (select e.Id 
                from eventparticipants as ep 
                inner join events as e on e.Id = ep.eventID 
                where ep.userid=".$_SESSION['usernameId'].") 
                OR g.ID in 
                    (select gp2.groupID 
                    from groupparticipants as gp2 
                    where gp2.userID)");

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