<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
 
    if(isset($_SESSION['username']))
    {
        if($_SESSION["username"]!=null){

            $idSelected = $_POST['id'];
                $result = $db->query("select 
                                        g.ID,
                                        g.name
                                        from groups as g
                                        where g.id =".$idSelected." order by g.name Asc");
                $allInfo = array();
    
                if($result){
                    while($row = $result->fetch_assoc()){
                        $allInfo[] = $row;
                    }
                    $arrayInfo[0] = true;
                    $arrayInfo[1]['groupheader'] = $allInfo;
                }
    
                $result = $db->query("select 
                                        gp.userID,
                                        u.name
                                        from groupparticipants as gp 
                                        inner join users as u on u.id = gp.userID
                                        where gp.groupID=".$idSelected." order by u.name Asc");
                $allInfo = array();
    
                if($result){
                    while($row = $result->fetch_assoc()){
                        $allInfo[] = $row;
                    }
                    $arrayInfo[0] = true;
                    $arrayInfo[1]['groupParticipant'] = $allInfo;
                }
                
                $result = $db->query("select p.ID,u.name,p.type,p.date,pt.content from postgroup as p  inner join posttexttogroup as pt on pt.postID = p.ID
                                inner join users as u on u.id = p.userID where pt.groupID = ".$idSelected." order by p.date desc");
                if($result){
                    while($row = $result->fetch_assoc()){
                    $allCommentInfo = array();
                    /*$result2 = $db->query("select u.name,c.comment,c.date from commentpostgroup as c inner join users as u on u.ID = c.userID where c.postID = ".$row['ID']."");
                    while($row2 = $result2->fetch_assoc()){
                        $allCommentInfo[] = $row2;
                    }
                    $row['children'] = $allCommentInfo;*/
                    $allInfo[] = $row;
                    }
                $arrayInfo[0] = true;
                $arrayInfo[1]['groupPostContent'] = $allInfo;
                }           
    
            }

    }
    echo json_encode($arrayInfo);
?>