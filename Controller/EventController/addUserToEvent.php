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
        $eventId = $_POST['eventId'];
        $userId = $_SESSION['usernameId'];
        $name = "%".$_POST['name']."%";

        if($id == "" || $eventId == ""){
            echo json_encode(false);
            return;
        }
        //insert into event participants
        $stmt = $db->prepare("insert into eventparticipants(userID,eventID) values(?,?)");
        $stmt->bind_param("ii", $id, $eventId);
        $stmt->execute();

        //insert into access for the event
        $stmt = $db->prepare("insert into accevent(userID,access,eventID) values(?,1,?)");
        $stmt->bind_param("ii", $id, $eventId);
        $stmt->execute();

        //get user info for event
        $stmt = $db->prepare("select 
        u.ID, 
        u.name,
        Case 
            when u.ID in (select userId from eventparticipants where eventID = ?) then 1
            else 0
        end as isRegistered
     from users as u where name like ?");
        $stmt->bind_param("is", $eventId, $name);
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

        $stmt = $db->prepare("select 
        e.userID,
        u.name
        from eventparticipants as e 
        inner join users as u on u.id = e.userID
        where e.eventID=? order by u.name Asc");
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $result = $stmt->get_result();
        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[2] = $allInfo;
        }

        $stmt = $db->prepare("Select 
        Case
        when exists(select id from users where isAdmin =1 and id=?) then 1
        when exists(select ID from events where isDeleted=0 and ID=? and managerID = ?) then 1
        else 0
        end as canEdit 
        from users
        where id =?");
        $stmt->bind_param("iiii", $userId, $eventId, $userId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $allInfo = array();
        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[3]['canEdit'] = $allInfo;
        }
    }
    echo json_encode($arrayInfo);
?>