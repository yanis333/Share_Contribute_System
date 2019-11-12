<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $allInfo= array();
    $arrayInfo[0] = false;
    if(isset($_SESSION['username']))
    if($_SESSION["username"] != null){
        $content = $_POST['content'];
        $type = $_POST['type'];
        $eventID = $_POST['eventID'];

        if($content == "" || $type == ""){
            echo json_encode(false);
            return;
        }
        $db->query("insert into postevent(userID,type,date)values(".$_SESSION["usernameId"].",'".$type."', NOW())");

        $result = $db->query("select * from postevent where userID =".$_SESSION["usernameId"]." and type = '".$type."' order by ID desc");
        if($result){
            $postInserted = array();
            while($row = $result->fetch_assoc()){
                $postInserted[] = $row;
                break;
            }
        $db->query("insert into posttexttoevent(eventID,content,postID)values(".$eventID.",'".$content."', ".$postInserted[0]['ID']);  
        
        $result = $db->query("select p.ID,u.name,p.type,p.date,pt.content from postevent as p  inner join posttexttoevent as pt on pt.postID = p.ID
                                inner join users as u on u.id = p.userID where pt.eventID = ".$eventID." order by p.date desc");
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