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
                $arrayInfo[0] = true;
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

            $result = $db->query("select * 
                                from users 
                                where id in 
                                    (select userID 
                                    from eventparticipants
                                    where eventID=".$idSelected.");");
            $allInfo = array();

            if($result){
                while($row = $result->fetch_assoc()){
                    $allInfo[] = $row;
                }
                $arrayInfo[0] = true;
                $arrayInfo[1]['allUsersOfEvent'] = $allInfo;
            }

             $result = $db->query("select p.ID,u.name,p.type,p.date,pt.content from postevent as p  inner join posttexttoevent as pt on pt.postID = p.ID
                                    inner join users as u on u.id = p.userID where pt.eventID = ".$idSelected." order by p.date desc");
            $allInfo = array();
            if($result){
                while($row = $result->fetch_assoc()){
                    $allCommentInfo = array();
                    $result2 = $db->query("Select u.name,c.comment,c.date from commentpostevent as c inner join users as u on u.ID = c.userID where c.postID = ".$row['ID']."");
                    while($row2 = $result2->fetch_assoc()){
                        $allCommentInfo[] = $row2;
                    }
                    $row['children'] = $allCommentInfo;
                    $allInfo[] = $row;
                }
                $arrayInfo[1]['eventPostContent'] = $allInfo;
            }

            $result = $db->query("select 
                                    e.managerID
                                    from events as e 
                                    where e.ID =".$idSelected."");
            $allInfo = array();

            if($result){
                while($row = $result->fetch_assoc()){
                    $allInfo[] = $row;
                }
                $arrayInfo[0] = true;
                $arrayInfo[1]['eventManager'] = $allInfo;
                $arrayInfo[1]['loggedInUserId'] = $_SESSION['usernameId'];
            }

        }

    }
    echo json_encode($arrayInfo);
?>