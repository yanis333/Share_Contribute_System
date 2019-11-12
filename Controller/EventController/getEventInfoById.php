<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
    if(isset($_SESSION['username']))
    {if($_SESSION["username"]!=null){
        $idSelected = $_POST['id'];
            $result = $db->query("select 
                                    e.ID,
                                    e.name
                                    from events as e 
                                    where e.id =".$idSelected." order by e.name Asc");
            $allInfo = array();

            if($result){
                while($row = $result->fetch_assoc()){
                    $allInfo[] = $row;
                }
                $arrayInfo[0] = true;
                $arrayInfo[1]['eventheader'] = $allInfo;
            }

            $result = $db->query("select 
                                    e.userID,
                                    u.name
                                    from eventparticipants as e 
                                    inner join users as u on u.id = e.userID
                                    where e.eventID =".$idSelected." order by u.name Asc");
            $allInfo = array();

            if($result){
                while($row = $result->fetch_assoc()){
                    $allInfo[] = $row;
                }
                $arrayInfo[1]['eventParticipant'] = $allInfo;
            }

            $result = $db->query("select 
                                    e.ID,
                                    g.name
                                    from groups as g 
                                    inner join events as e on e.ID = g.eventID
                                    where e.ID =".$idSelected." order by g.name Asc");
            $allInfo = array();

            if($result){
                 while($row = $result->fetch_assoc()){
                     $allInfo[] = $row;
                     }
                 $arrayInfo[1]['eventGroup'] = $allInfo;
             }

        }

    }
    echo json_encode($arrayInfo);
?>