<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <title>Soul Society</title>
            <style>
                #searchEventInput {
                width: 50%;
                padding: 12px 20px;
                margin: 8px 0;
                margin-left:15%;
                margin-top:5%;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 12px;
                box-sizing: border-box;
                }

                #searchEventButton {
                width: 5%;
                background-color: #1F11F7;
                color: white;
                padding: 14px 20px;
                border: none;
                border-radius: 12px;
                cursor: pointer;
                margin-left:1%;
                }

                #searchEventButton:hover {
                background-color: #1006A6;
                }

                #createEventButton {
                width: 5%;
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                border: none;
                border-radius: 12px;
                cursor: pointer;
                margin-left:1%;
                }

                #createEventButton:hover {
                background-color: #45a049;
                }

                input[type=text], select {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                }

                .eventGroup {
                margin-top :2%;
                margin-left : 25%;
                margin-bottom : 1%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 30%;
                box-shadow: 5px 10px #888888;
                }

                .userGroup {
                margin-top :2%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 90%;
                }

                .allParticipantGroup {
                    margin-top :2%;
                    border-radius: 5px;
                    background-color: #f2f2f2;
                    width: 90%;
                }

                .eventButton, .userButton{
                    float:right;
                }

                .eventHeader {
                margin-top :2%;
                margin-left : 1%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 20%;
                height:50%;
                float:left;
                
                }
                .eventBody {
                margin-top :2%;
                margin-left : 3%;
                margin-bottom:2%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 35%;
                float:left;
                
                }
                #eventPostBody {
                margin-top :5%;
                margin-left : 25%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 35%;
                }

                .flexBox {
                display : flex;
                flex-direction : column;
                }

                .eventRightSideInfo {
                margin-top :5%;
                margin-left : 3%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 40%;
                float:left; 
                justify-content : flex-start;               
                }

                .groupRightSideInfo {
                margin-top :2%;
                margin-left : 3%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 40%;
                float:left; 
                justify-content : flex-end;   
                }
                .eventBoxPost {
                margin-top :2%;
                margin-left : 3%;
                border-radius: 5px;
                padding: 10px;
                width: 40%;
                float:left;  
                }

                #mainSpecificEvent {
                    position:relative;
                    padding:0;
                    margin:0;
                    overflow-x:hidden;
                    overflow-y : hidden;
                    height:110%;
                    width :110%;
                    transition: background-color .5s;
                }

                #event {
                    overflow-y:auto;
                }
                
                #deleteEventButton {
                    background-color : red;
                    border-radius : 5px ;
                    border : 1px solid black;
                }

            </style>
        </head>
        <body style="overflow-x:hidden">
        <?php include("../Dashboard/navbar.php") ?>
        
        <div id="main" >
        <span style="font-size:30px;cursor:pointer" id="openNav">&#9776; Menu</span><br>
            <div id="mainGenericEvent">
                <input type="text" id="searchEventInput" placeholder="Search Event...">
                <button id="searchEventButton">Search</button>
                <button id="createEventButton" data-toggle="modal" data-target="#createEventModal">Create</button>
                <div id="event" ></div>
            </div>
            <div id="mainSpecificEvent" >
            <button id="backToSearchEvent" style="margin-left:40%">Back</button><br>
                <div class ="eventHeader">
                    <h3><span id="eventChoseName"></span></h3>
                    <input id="storeEventId" hidden />
                    <button data-toggle="modal" data-target="#inviteUserModal">Invite</button>
                    <button>Edit</button>
                    <button id="deleteEventButton">Delete</button>
                    <button id="archiveEventButton">Archive</button><br><br>
                    <button id="addNewGroupToEvent" data-toggle="modal" data-target="#addNewGroup">Add Group</button>
                    <br>
                    <span>Nb of participants : </span><span id="nbParticipantEvent"></span><br>
                    <span>Nb of groups : </span><span id="nbGroupEvent"></span><br>
                    <span>Number of post : </span><span id="nbPostEvent"></span><br>
                    <span>Number of Image : </span><span id="nbImageEvent"></span><br>
                    <span>Number of Video : </span><span id="nbVideoEvent"></span><br>
                </div>
                <div class="eventBody">
                    <input type="text" id="postText" placeholder="Write Post..." />
                    <button id="eventPostText" >Post</button><button >Image</button><button >Video</button>
                    
                    
                </div>
                <div id="postContentDiv" class="eventBoxPost">

                    </div>
                <div class="flexBox">
                <div class="eventRightSideInfo">
                    <h3>All Participants</h3>
                    <div id="eventAllParticipants"></div>
                    <br>
                </div><br>
                <div class="groupRightSideInfo" style="float:right">
                    <h3>All Groups</h3>
                    <div id="eventAllGroups"></div>
                    <br>
                </div>
                </div><br><br>
            </div>
            
        </div>

        <!--MODAL SECTION -->
        <div class="modal fade" id="inviteUserModal">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                   
                        <h4 class="modal-title">Invite User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="searchUserToInvite" placeholder="Search User...">
                        <button id="searchUserToInviteButton">Search</button>
                        <div id="UserSearched">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                
                </div>
        </div>

        <div class="modal fade" id="addNewGroup">
            <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Name of the group</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                   
                        <span> Group Name :</span> <input type="text" id="groupName" placeholder="Name">
                            <div id="userEventList"> </div>
                            <br>
                            <button id="addGroupButton" data-dismiss="modal">Create Group</button>
                    </div>
                </div>    
           
            </div>
                
        </div>
        </div>
    
        <div class="modal fade" id="createEventModal">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                   
                    <h4 class="modal-title">Create Event</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <span> Name :</span><br> <input type="text" id="nameEvent" ><br>
                    <span> Address :</span><br> <input type="text" id="addressEvent" ><br>
                    <span> Phone Number :</span><br> <input type="text" id="phoneNumberEvent" ><br>
                    <span> Type of organization :</span><br> <input type="text" id="typeOfOrgEvent" ><br>
                    </div>
                    <div class="modal-footer">
                    <button type="button" id="saveEvent" class="btn btn-default" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                
                </div>
        </div>

            <script>
                $(document).ready(function() {
                    $("#mainSpecificEvent").hide();
                    $("#deleteEventButton").hide();
                    $("#archiveEventButton").hide();

                    $(document).on("click","button",function(){
                       if(this.id.includes("eventOpen")){
                           var idOfButtonClicked = this.id.substring(9);
                           $.post('../../Controller/EventController/getEventInfoById.php',{id:idOfButtonClicked},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    $("#mainSpecificEvent").show();
                                    $("#mainGenericEvent").hide();
                                    $("#eventChoseName").text(info[1]['eventheader'][0]['name']);
                                    $("#storeEventId").val(idOfButtonClicked);
                                    createRightAllParticipantsBox(info[1]['eventParticipant']);
                                    createRightAllGroupsBox(info[1]['eventGroup']);
                                    createPostBox(info[1]['eventPostContent']);
                                    if(info[1]['eventManager'][0]['managerID'] === info[1]['loggedInUserId'])
                                    {
                                        $("#deleteEventButton").show();
                                        $("#archiveEventButton").show();
                                    }
                                }else{
                                }
                            });
                       }else if(this.id.includes("commentPostIdButton")){
                        var idOfButtonClicked = this.id.substring(19);
                        if($("commentPostId"+idOfButtonClicked).val() != ""){
                            var saliha ="#commentPostId"+idOfButtonClicked;
                            var yanis = $("#commentPostId"+idOfButtonClicked).val();

                            $.post('../../Controller/EventController/saveComment.php',{id:idOfButtonClicked,comment:$("#commentPostId"+idOfButtonClicked).val(),eventId:$("#storeEventId").val()},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    createPostBox(info[1]['eventPostContent']);
                                }else{
                                }
                            });
                        }
                       }else if(this.id.includes("addUserId")){
                        var idOfButtonClicked = this.id.substring(9);
                            $.post('../../Controller/EventController/addUserToEvent.php',{id:idOfButtonClicked,eventId:$("#storeEventId").val(),name:$("#searchUserToInvite").val()},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    createUserBox(info[1]);
                                    createRightAllParticipantsBox(info[2]);
                                }else{
                                }
                            });
                       }else if(this.id.includes("eventRegister")){
                        var idOfButtonClicked = this.id.substring(13);
                            $.post('../../Controller/EventController/RequestToEvent.php',{eventId:idOfButtonClicked,name:$("#searchEventInput").val()},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    createEventBox("All Events you searched for!",info[1]);
                                }else{
                                }
                            });
                       }
                    
                
                    });

                    function createEventBox(triggerAction,arrayofEvent){
                        $("#event").empty();
                        $("#event").append("<h3 style='margin-left:25%'> "+triggerAction+" </h3>");
                        for(var x = 0; x<arrayofEvent.length;x++ ){
                            var eventHtmlBox = "<div class = 'eventGroup' > "+
                                                "<span> Event Name : "+arrayofEvent[x]['name']+"</span>";
                                                if(arrayofEvent[x]['isRegistered'] == 0){
                                                    eventHtmlBox +=  "<button id= \"eventRegister"+arrayofEvent[x]['ID']+"\" class='eventButton'  >Request</button><br>";
                                                }else if(arrayofEvent[x]['isRegistered'] == 1){
                                                    eventHtmlBox +=  "<button id= \"eventOpen"+arrayofEvent[x]['ID']+"\" class='eventButton'>Open</button><br>";
                                                }else{
                                                    eventHtmlBox +=  "<button  class='eventButton' disabled>Pending request</button><br>";
                                                }
                                                
                                                eventHtmlBox +=  "</div>"
                                                
                            $("#event").append(eventHtmlBox);
                        }
                    }
                    function createRightAllParticipantsBox(arrayofAllParticipant){
                        $("#eventAllParticipants").empty();

                        $("#nbParticipantEvent").text(arrayofAllParticipant.length);
                        for(var x = 0; x<arrayofAllParticipant.length;x++ ){
                            var participantHtmlBox = "<div class = 'allParticipantGroup' > "+
                                                "<span> "+(x+1)+") "+arrayofAllParticipant[x]['name']+"</span>";
                                                
                                                participantHtmlBox +=  "</div>"
                                                
                            $("#eventAllParticipants").append(participantHtmlBox);
                        }
                    }
                    function createRightAllGroupsBox(arrayofAllGroup){
                        $("#eventAllGroups").empty();

                        $("#nbGroupEvent").text(arrayofAllGroup.length);
                        for(var x = 0; x<arrayofAllGroup.length;x++ ){
                            var groupHtmlBox = "<div class = 'allGroup' > "+
                                                "<span> "+(x+1)+") "+arrayofAllGroup[x]['name']+"</span>";
                                                
                                                groupHtmlBox +=  "</div>"
                                                
                            $("#eventAllGroups").append(groupHtmlBox);
                        }
                    }
                    function createUserBox(arrayofUser){
                        $("#UserSearched").empty();
                        for(var x = 0; x<arrayofUser.length;x++ ){
                            var userHtmlBox = "<div class = 'userGroup'> "+
                                                "<span> User Name : "+arrayofUser[x]['name']+"</span>";
                                                if(arrayofUser[x]['isRegistered'] == 0){
                                                    userHtmlBox +=  "<button id= \"addUserId"+arrayofUser[x]['ID']+"\" class='userButton'>Add</button><br>";
                                                }else{
                                                    userHtmlBox +=  "<button id= \"addUserId"+arrayofUser[x]['ID']+"\" class='userButton' style =\"background-color:green\" disabled>Registered</button><br>";
                                                }
                                                userHtmlBox += "</div>"
                                                
                            $("#UserSearched").append(userHtmlBox);
                        }
                    }
                    function createCommentBox(arrayofComment){
                        //$("#nbPostEvent").text(arrayofComment.length);
                        var commentHtmlBox = "<br><br>";
                        for(var x = 0; x<arrayofComment.length;x++ ){
                             commentHtmlBox += "<div style = 'border-top: 1px black solid;margin-left:2%'>" +
                                                "<span style=\"margin-right:5%\">"+arrayofComment[x]['name']+"</span> "+
                                                "<span> "+arrayofComment[x]['date']+"</span>"+
                                                "<h6>"+arrayofComment[x]['comment']+"</h6>"+
                                                "</div><br>"
                                                
                            
                        }
                        return commentHtmlBox;
                    }
                    function createPostBox(arrayofPost){
                        $("#postContentDiv").empty();
                        $("#nbPostEvent").text(arrayofPost.length);
                        for(var x = 0; x<arrayofPost.length;x++ ){
                            var postHtmlBox = "<div class = 'userGroup'>" +
                                                "<h5>"+arrayofPost[x]['name']+"</h4> "+
                                                "<span> "+arrayofPost[x]['date']+"</span><br><br>"+
                                                "<h4>"+arrayofPost[x]['content']+"</h4><br>"+
                                                "<input id=\"commentPostId"+arrayofPost[x]['ID']+"\" type=text placeholder=\"Comment...\" />"+
                                                "<button id=\"commentPostIdButton"+arrayofPost[x]['ID']+"\">Comment</button>"+
                                                createCommentBox(arrayofPost[x]['children'])+
                                                "</div>"
                                                
                            $("#postContentDiv").append(postHtmlBox);
                        }
                    }
                    function displayUserList(arrayofUser){
                        $("#userEventList").empty();
                   
                        for(var x = 0; x<arrayofUser['allUsersOfEvent'].length;x++ ){
                            var userHtmlBox = "<div class = 'userGroup'> "+
                                                "<span> "+arrayofUser['allUsersOfEvent'][x]['name']+"</span>";
                                                
                                                    userHtmlBox +=  "<input type='checkbox' name='addUserIdToGroup' id= \"addUserIdToGroup "+arrayofUser['allUsersOfEvent'][x]['id']+"\"class='userButton' value="+arrayofUser['allUsersOfEvent'][x]['id']+" ?> </input><br>";
                                                
                                                userHtmlBox += "</div>"
                                                
                            $("#userEventList").append(userHtmlBox);
                        }
                   
                    }

                    $("#eventPostText").click(function(){
                        if($("#postText").val() != ""){
                            $.post('../../Controller/EventController/postContent.php',{content:$("#postText").val(),type:"Text",eventID:$("#storeEventId").val()},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    createPostBox(info[1]);
                                }else{
                                }
                            });
                        }
                    });

                    $("#addNewGroupToEvent").click(function(){
                       $.post('../../Controller/EventController/getEventInfoById.php',{id:$("#storeEventId").val()},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    displayUserList(info[1]);
                                }else{
                                    alert("LOL");
                                }
                            });

                        
                    });

                    $("#backToSearchEvent").click(function(){
                        $("#mainSpecificEvent").hide();
                        $("#mainGenericEvent").show();
                    });

                    $("#searchUserToInviteButton").click(function(){
                        if($("#searchUserToInvite").val() != ""){
                            $.post('../../Controller/EventController/searchUserToEventId.php',{name:$("#searchUserToInvite").val(),id:$("#storeEventId").val()},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    createUserBox(info[1]);
                                }else{
                                }
                            });
                        }else{
                            alert("You need to enter a user name to search for!");
                        }
                    });

                    $("#addGroupButton").click(function(){
                        var checked = []
                         $("input[name='addUserIdToGroup']:checked").each(function ()
                                    {checked.push(parseInt($(this).val())); });

                        if($("#groupName").val() != ""){
                            $.post('../../Controller/GroupController/addGroup.php',{name:$("#groupName").val(),id:$("#storeEventId").val(),userId:JSON.stringify(checked)},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                   alert("The group is created successfully !");
                                   $('#groupName').val('');
                                   createRightAllGroupsBox(info[2]);
                                }
                            });
                        }else{
                            alert("You need a name for the group!");
                        }


                    });

                    $("#searchEventButton").click(function(){
                        if($("#searchEventInput").val() != ""){
                            $.post('../../Controller/EventController/searchEvent.php',{name:$("#searchEventInput").val()},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    createEventBox("All Events you searched for!",info[1]);
                                }else{
                                    createEventBox("No Events for this search !",[]);
                                }
                            });
                        }else{
                            alert("You need to search for a specific event");
                        }
                    });

                    $.post('../../Controller/EventController/searchUserEvent.php',{},function(data){
                            var info = JSON.parse(data);
                            if(info[0]){
                                createEventBox("All Events you are registered for!",info[1]);
                            }else{
                                
                            }
                        });

                    $("#saveEvent").click(function(){
                        if($("#nameEvent").val() == ""||$("#addressEvent").val() == ""||$("#phoneNumberEvent").val() == ""||$("#typeOfOrgEvent").val() == ""){
                            alert("All fields must be field");
                        }else{
                            $.post('../../Controller/EventController/createEvent.php',{name:$("#nameEvent").val(),address:$("#addressEvent").val(),phone:$("#phoneNumberEvent").val(),type:$("#typeOfOrgEvent").val()},function(data){
                            var info = JSON.parse(data);
                            if(info[0]){
                                createEventBox("All Events you are registered for!",info[1]);
                                alert("Event Created Successfully");
                            }else{
                                alert("You need to be an admin to create an event!");
                            }
                        });
                        }
                    });

                    $("#deleteEventButton").click(function(){
                        /*$.post('../../Controller/EventController/deleteEvent.php',{id:$("#storeEventId").val()},function(data){
                            var info = JSON.parse(data);
                            if(info[0]){
                                alert("Event deleted Successfully");
                            }else{
                                alert("You need to be an admin to create an event!");
                            }
                        });*/
                    });

                });
            </script>
        </body>
    </html>