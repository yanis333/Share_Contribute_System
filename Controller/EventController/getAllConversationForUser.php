<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $arrayInfo[0] = false;
 
    if(isset($_SESSION['username']))
    {
        if($_SESSION["username"]!=null){
            $userId = $_SESSION['usernameId'];
            $stmt = $db->prepare("select 
            c.ID,
            Case 
                when 
                    c.userID1 = ? then (select us.name from users as us where us.ID = c.userID2)
                    else
                    (select us.name from users as us where us.ID = c.userID1)
            end as name ,
            Case 
                when 
                ? = ? then ?
            end as usernameID 
            from conversation as c
            where 
                c.userID1 = ? 
            OR 
                c.userID2 = ?");
            $stmt->bind_param("iiiiii", $userId, $userId, $userId, $userId, $userId, $userId);
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

        }
    }
    echo json_encode($arrayInfo);
?>