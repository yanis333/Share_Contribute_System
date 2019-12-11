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
            $userId = $_SESSION['usernameId'];

            $stmt = $db->prepare("select 
            message,
            CASE
                WHEN
                    userID=?
                THEN 1
                ELSE 0
                END as mine
            from messageuser
            where conversationID = ? order by date");
            $stmt->bind_param("ii", $userId, $idSelected);
            $stmt->execute();
            $result = $stmt->get_result();
            $allInfo = array();
            if($result){
                while($row = $result->fetch_assoc()){
                    $allInfo[] = $row;
                }
                $arrayInfo[1] = $allInfo;
            }

            $stmt = $db->prepare("select 
            CASE
            When c.userID1 = 1 then (select name from users where ID = c.userID2)
            else (select name from users where ID = c.userID1)
            end as name
        from conversation as c
            where (c.userID1=? Or c.userID2 ?)
                and c.Id=?");
            $stmt->bind_param("iii", $userId, $userId, $idSelected);
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
    }
    echo json_encode($arrayInfo);
?>