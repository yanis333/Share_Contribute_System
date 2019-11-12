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
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 30%;
                box-shadow: 5px 10px #888888;
                
                }
                .userGroup{
                margin-top :2%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 90%;
                
                }
                .allParticipantGroup{
                    margin-top :2%;
                    border-radius: 5px;
                    background-color: #f2f2f2;
                    padding: 20px;
                    width: 90%;
                    
                }
                .eventButton, .userButton{
                    float:right;
                }
                .eventHeader {
                margin-top :3%;
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
                #eventPostBody{
                margin-top :5%;
                margin-left : 25%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 35%;}

                .eventRightSideInfo {
                margin-top :2%;
                margin-left : 3%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 20%;
                float:left;
                
                }
                #mainSpecificEvent{
                    position:relative;
                    padding:0;
                    margin:0;

                    height:110%;
                    width :110%;
                    transition: background-color .5s;
                }
                #event{
                    overflow-y:scroll;
                }
            </style>
        </head>
        <body>
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
                    <button>Edit</button><br><br>

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
                <div class="eventRightSideInfo">
                    <h3>All Participants</h3>
                    <div id="eventAllParticipants"></div>
                    <br>

                </div><br><br>
                <!--
                <div id="eventPostBody">
                    <h3>All Participants</h3>
                        <div id="eventAllParticipants"></div>
                        <br>
                </div>
                -->
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
                                                    eventHtmlBox +=  "<button id= \"eventRegister"+arrayofEvent[x]['ID']+"\" class='eventButton'  >Register</button><br>";
                                                }else{
                                                    eventHtmlBox +=  "<button id= \"eventOpen"+arrayofEvent[x]['ID']+"\" class='eventButton'>Open</button><br>";
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
                                                "<span> "+(x+1)+")"+arrayofAllParticipant[x]['name']+"</span>";
                                                
                                                participantHtmlBox +=  "</div>"
                                                
                            $("#eventAllParticipants").append(participantHtmlBox);
                        }
                    }
                    function createUserBox(arrayofUser){
                        $("#UserSearched").empty();
                        for(var x = 0; x<arrayofUser.length;x++ ){
                            var userHtmlBox = "<div class = 'userGroup'> "+
                                                "<span> User Name : "+arrayofUser[x]['name']+"</span>";
                                                if(arrayofUser[x]['isRegistered'] == 0){
                                                    userHtmlBox +=  "<button id= \"addUserId"+x+"\" class='userButton'>Add</button><br>";
                                                }else{
                                                    userHtmlBox +=  "<button id= \"addUserId"+x+"\" class='userButton' style =\"background-color:green\" disabled>Registered</button><br>";
                                                }
                                                userHtmlBox += "</div>"
                                                
                            $("#UserSearched").append(userHtmlBox);
                        }
                    }
                    function createPostBox(arrayofPost){
                        $("#UserSearched").empty();
                        for(var x = 0; x<arrayofUser.length;x++ ){
                            var userHtmlBox = "<div class = 'userGroup'> "+
                                                "<span> User Name : "+arrayofUser[x]['name']+"</span>";
                                                if(arrayofUser[x]['isRegistered'] == 0){
                                                    userHtmlBox +=  "<button id= \"addUserId"+x+"\" class='userButton'>Add</button><br>";
                                                }else{
                                                    userHtmlBox +=  "<button id= \"addUserId"+x+"\" class='userButton' style =\"background-color:green\" disabled>Registered</button><br>";
                                                }
                                                userHtmlBox += "</div>"
                                                
                            $("#UserSearched").append(userHtmlBox);
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

                    $("#searchEventButton").click(function(){
                        if($("#searchEventInput").val() != ""){
                            $.post('../../Controller/EventController/searchEvent.php',{name:$("#searchEventInput").val()},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    createEventBox("All Events you searched for!",info[1]);
                                    //createEventBox("Results for yopur search !",info[1])
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

                });
            </script>
        </body>
    </html>