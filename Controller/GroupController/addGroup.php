<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $allInfo= array();
    $arrayInfo[0] = false;
    $allUserID = array();

    if(isset($_SESSION['username']))
    if($_SESSION["username"] != null){

        $name = $_POST['name'];
        $id = $_POST['id'];
        $allUserID = json_decode($_POST['userId']);
       	array_push($allUserID, intval($_SESSION['usernameId']));
	//echo var_dump($allUserID);
	//return;
	//echo $name;
	//echo $id;
	//foreach($allUserID as $value){
	//	echo "user ID: ".$value;
	//}
        //return;
	if($name == "" || $id==""){
            echo json_encode(false);
            return;
        }
	//if(empty($allUserID)){
	//	$allUserID = $_SESSION['usernameId'];
		//echo "hello my id is: ${allUserID}"; return;
	//}
	//echo var_dump($allUserID) . "/n";
	//echo "allUserID: " . $allUserID;
	//return;
		
        $db->query("insert into `groups`(name,managerID,creationDate,eventID) values('".$name."',".$_SESSION['usernameId'].",'". date('Y-m-d H:i:s')."',".$id.")");
        $result2 = $db->getLastInsertedId();
        $result = $db->query("select id from `groups` where name='".$name."' AND managerID=".$_SESSION['usernameId']);
        
        if($result2){
                mkdir("../../Files/Groups/".$result2, 0700);
        }

        if($result){
            
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[1] = $allInfo;
            
        }
        
        foreach($allUserID as $value)  {
             $db->query("insert into groupparticipants (userID,groupID) values (".$value.",".$arrayInfo[1][0]['id'].")");
            }


        
        $result = $db->query("select 
                                    e.ID,
                                    g.name,
                                    Case When true then 1 end as isRegistered
                                    from `groups` as g 
                                    inner join events as e on e.ID = g.eventID
                                    where g.isDeleted=0 and e.isDeleted=0 and e.ID =".$id." order by g.name Asc");

        $allInfo= array();
        if($result){
            
            while($row = $result->fetch_assoc()){
                $allInfo[] = $row;
            }
            $arrayInfo[0] = true;
            $arrayInfo[2]= $allInfo;
            
        }
         

    }
    echo json_encode($arrayInfo);
?>
