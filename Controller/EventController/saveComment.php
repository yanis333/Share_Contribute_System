<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $allInfo= array();
    $arrayInfo[0] = false;
    if(isset($_SESSION['username']))
    if($_SESSION["username"] != null){
        $id = $_POST['id'];
        $comment = $_POST['comment'];
        $eventID = $_POST['eventId'];

        if($id == "" || $comment == ""){
            echo json_encode(false);
            return;
        }
        $db->query("insert into commentpostevent(userID,postID,comment,date) values(".$_SESSION['usernameId'].",".$id.",'".$comment."',NOW())");

        $result = $db->query("select p.ID,u.name,p.type,p.date,pt.content from postevent as p  inner join posttexttoevent as pt on pt.postID = p.ID
                                    inner join users as u on u.id = p.userID where pt.eventID = ".$eventID." order by p.date desc");
        
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
                $arrayInfo[0] = true;
                $arrayInfo[1]['eventPostContent'] = $allInfo;
            }
            $result = $db->query("select aty.TypeRef as access from accevent as ae inner join acctype as aty on aty.ID = ae.access where ae.eventID = ".$eventID." and ae.userID =".$_SESSION['usernameId']."");
            $allInfo = array();
            if($result){
                while($row = $result->fetch_assoc()){
                    $allInfo[] = $row;
                }
                $arrayInfo[1]['access'] = $allInfo;
            }
    }
    echo json_encode($arrayInfo);
?>