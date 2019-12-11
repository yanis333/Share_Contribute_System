<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
    $sessionUserId = $_SESSION['usernameId'];
    if(isset($_SESSION['username'])){
        $userId = $_POST['userId'];
        $eventId = $_POST['eventId'];

        $stmt = $db->prepare("delete from eventrequest where userID = ? and eventID = ?");
        $stmt->bind_param("ii", $userId, $eventId);
        $stmt->execute();

        /*                GROUP REQUESTS                      */
        $stmt = $db->prepare("select 
            u.ID as userID, 
            u.name,
            g.id as groupID,
            g.name as groupname
        from grouprequest gr
        inner join `groups` as g on g.id = gr.groupID 
        inner join users as u on u.ID = gr.userID
        where g.managerID = ?");
        $stmt->bind_param("i", $sessionUserId);
        $stmt->execute();
        $result = $stmt->get_result();
        $allInfo = array();
        if($result){
            
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[1] = $allInfo;
        }

        /*                EVENT REQUESTS                      */
        $stmt = $db->prepare("select 
            u.ID as userID, 
            u.name,
            e.ID as eventID,
            e.name as eventname
        from eventrequest er
        inner join events as e on e.ID = er.eventID 
        inner join users as u on u.ID = er.userID 
        where e.managerID = ?");
        $stmt->bind_param("i", $sessionUserId);
        $stmt->execute();
        $result = $stmt->get_result();
        $allInfo = array();
        if($result){
            
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[2] = $allInfo;
        }
    }
    echo json_encode($arrayInfo);
?>