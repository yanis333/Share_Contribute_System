<?php
     include('../../Model/Config/db_server.php');
     session_start();
     $db = new DB();
     $arrayInfo = array();
     $arrayInfo[0] = false;
     if(isset($_SESSION['username'])){
    
     if($_SESSION["username"]!=null) {

            $result = $db->query("select * 
                                    from groups as g 
                                    left join groupparticipants as gp on gp.groupID = g.id 
                                    where eventID in 
                                        (select e.Id 
                                        from eventparticipants as ep 
                                        inner join events as e on e.Id = ep.eventID 
                                        where ep.userid=".$_SESSION["usernameId"].") 
                                        OR g.ID in 
                                            (select gp2.groupID 
                                            from groupparticipants as gp2 
                                            where gp2.userID)");
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