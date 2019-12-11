<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
    $sessionUserId = $_SESSION['usernameId'];
 
    if(isset($_SESSION['username']))
    {if($_SESSION["username"]!=null){

        $idSelected = $_POST['id'];

        $stmt = $db->prepare("select e.ID,e.name from events as e where e.isDeleted=0 and e.id=? order by e.name Asc");
        $stmt->bind_param("i", $idSelected);
        $stmt->execute();
        $result = $stmt->get_result();

        $allInfo = array();
        $arrayInfo[1]['eventheader']= array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[1]['eventheader'] = $allInfo;
        }

        $stmt = $db->prepare("select e.userID, u.name from eventparticipants as e 
            inner join users as u on u.id = e.userID
            where e.eventID=? order by u.name Asc");
        $stmt->bind_param("i", $idSelected);
        $stmt->execute();
        $result = $stmt->get_result();

        $allInfo = array();
        $arrayInfo[1]['eventParticipant']=array();


        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[1]['eventParticipant'] = $allInfo;
        }

        $stmt = $db->prepare("select 
        e.ID,
        g.name
        from `groups` as g 
        inner join events as e on e.ID = g.eventID
        where e.isDeleted=0 and g.isDeleted=0 and e.ID =? order by g.name Asc");
        $stmt->bind_param("i", $idSelected);
        $stmt->execute();
        $result = $stmt->get_result();
        $allInfo = array();
		$arrayInfo[1]['eventGroup'] = array();
            if($result){
                 while($row = $result->fetch_assoc()){
                     $allInfo[] = $row;
                     }
                 $arrayInfo[1]['eventGroup'] = $allInfo;
            }

        $stmt = $db->prepare("select * 
        from users 
        where id in 
            (select userID 
            from eventparticipants
            where eventID=?);");
        $stmt->bind_param("i", $idSelected);
        $stmt->execute();
        $result = $stmt->get_result();
            
        $allInfo = array();

        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[1]['allUsersOfEvent'] = $allInfo;
        }

        $stmt = $db->prepare("select pe.ID,u.name,pe.type,pe.date,pt.content,pet.pathOfFile  from postevent as pe left join  posttexttoevent as pt on pt.postID = pe.Id 
        left join postelementtoevent as pet on pet.postID = pe.ID 
        inner join users as u on u.id = pe.userID where pet.eventID=? or pt.eventID=? order by pe.date desc");
        $stmt->bind_param("ii", $idSelected, $idSelected);
        $stmt->execute();
        $result = $stmt->get_result();

        $allInfo = array();
		$arrayInfo[1]['eventPostContent'] = array();
        if($result){
            while($row = $result->fetch_assoc()){
                $allCommentInfo = array();

                $stmt = $db->prepare("Select u.name,c.comment,c.date from commentpostevent as c inner join users as u on u.ID = c.userID where c.postID=?");
                $stmt->bind_param("i", $row['ID']);
                $stmt->execute();
                $result2 = $stmt->get_result();
                while($row2 = $result2->fetch_assoc()){
                    $allCommentInfo[] = $row2;
                }
                $row['children'] = $allCommentInfo;
                $allInfo[] = $row;
            }
            $arrayInfo[1]['eventPostContent'] = $allInfo;
        }

        $stmt = $db->prepare("select isActive as archive from events where ID=?");
        $stmt->bind_param("i", $idSelected);
        $stmt->execute();
        $result = $stmt->get_result();
        $allInfo = array();
        $arrayInfo[1]['archive'] = 1;
        if($result){
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[1]['archive'] = $allInfo;
        }

        $stmt = $db->prepare("select 
        CASE 
        when (u.isAdmin = 1) then 'All'
        when (u.isAdmin = 0 and u.id in (select userID from accevent where eventID=?)) then (select TypeRef from acctype where ID = ae.access)
        end as access
        from users as u
        left join accevent as ae on u.id= ae.userID
        left join acctype as aty on aty.ID = ae.access 
        where (u.isAdmin = 1 or ae.eventID =?) and u.id=?");
        $stmt->bind_param("iii", $idSelected, $idSelected, $sessionUserId);
        $stmt->execute();
        $result = $stmt->get_result();

        $allInfo = array();
        $arrayInfo[1]['access'] = array();
            if($result){
                while($row = $result->fetch_assoc()){
                    $allInfo[] = $row;
                }
                $arrayInfo[1]['access'] = $allInfo;
            }

            $stmt = $db->prepare("Select 
            Case
            when exists(select id from users where isAdmin =1 and id=?) then 1
            when exists(select ID from events where isDeleted=0 and ID=? and managerID=?) then 1
            else 0
            end as canEdit
            
            from users
            where id=?");
        $stmt->bind_param("iiii", $sessionUserId, $idSelected, $sessionUserId, $sessionUserId);
        $stmt->execute();
        $result = $stmt->get_result();
        $allInfo = array();
        $arrayInfo[1]['canEdit'] = array();
            if($result){
                while($row = $result->fetch_assoc()){
                    $allInfo[] = $row;
                }
                $arrayInfo[0] = true;
                $arrayInfo[1]['canEdit'] = $allInfo;
            }

        $stmt = $db->prepare("select managerID from events where isDeleted=0 and ID=?");
        $stmt->bind_param("i", $idSelected);
        $stmt->execute();
        $result = $stmt->get_result();
        $allInfo = array();
        $arrayInfo[1]['eventManager'] = array();
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
