<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <title>Soul Society</title>
            <style>
            body {
                overflow-x: hidden; 
            }

            #searchGroupInput {
                width: 50%;
                padding: 12px 20px;
                margin: 2% 0;
                margin-left:15%;
                margin-top:2%;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 12px;
                box-sizing: border-box;
            }
            
            #searchGroupButton {
                background-color: #1F11F7;
                color: white;
                padding: 14px 20px;
                border: none;
                border-radius: 12px;
                cursor: pointer;
                margin-left:1%;
                }

            #searchGroupButton:hover {
                background-color: #1006A6;
            }
            
            #clearButton {
                width: 5%;
                background-color: #FF5252;
                color: white;
                padding: 14px 20px;
                border: none;
                border-radius: 12px;
                cursor: pointer;
                margin-left:1%;
            }

            #clearButton:hover {
                background-color:  #FF2929;
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

            .listOfGroups {
                margin-top :2%;
                margin-left : 35%;
                margin-bottom : 4%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 60%;
                box-shadow: 5px 10px #888888;
            }

            .row2 {
                display: flex;
                flex-direction: row;
                justify-content: center;
            }

            .groupButton{
                float:right;
            }
               
            .groupBody {
                margin-top :2%;
                margin-left : 3%;
                margin-bottom:2%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 35%;
                float:left;
            }
            
            .groupRightSideInfo {
                margin-top :5%;
                margin-left : 3%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 40%;
                float:left; 
                justify-content : flex-start;      
            }
            
            .myGroupClass {
                margin-top :5%;
                margin-left : 3%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 10px;
                width: 150%;
                float:left; 
                justify-content : flex-start;      
            }
            
            .groupHeader {
                margin-top :2%;
                margin-left : 1%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 20%;
                height:50%;
                float:left;
            }
            
            .groupBoxPost {
                margin-top :2%;
                margin-left : 3%;
                border-radius: 5px;
                padding: 10px;
                width: 40%;
                float:left;  
            }
            
            .flexBox {
                display : flex;
                flex-direction : column;
            }
            
            .column {
                float: left;
                width: 50%;
            }

            .userGroupPost {
                margin-top :2%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 90%;
            }
          
            </style>
        </head>
        <body>
        <?php include("../Dashboard/navbar.php") ?>

        <div id="main">
            <div id="mainGenericGroup">
            <span style="font-size:30px;cursor:pointer" id="openNav">&#9776; Menu</span><br>
            <div class="row2">
                <div id="group2"></div>
            </div>
            <input type="text" id="searchGroupInput" placeholder="Search Group...">
            <button id="searchGroupButton">Search</button>
            <button id="clearButton">Clear</button>
            <div class="row">
                <div class="column" id="group" ></div>
                <div>
                    <div class="myGroupClass">
                        <h3>My groups</h3>
                        <div id="myGroups"></div>
                        <br>
                    </div><br>
                </div><br><br>
            </div> 
        </div>

         <div id="mainSpecificGroup" >
            <button id="backToSearchGroup" style="margin-left:40%">Back</button><br>
                <div class ="groupHeader">
                    <h3><span id="groupName"></span></h3>
                    <input id="storeGroupId" hidden />
                    <button data-toggle="modal" data-target="#inviteUserModal">Invite</button>
                    <br>
                    <span>Nb of participants : </span><span id="nbParticipantGroup"></span><br>
                    <span>Number of post : </span><span id="nbPostGroup"></span><br>
                    <span>Number of Image : </span><span id="nbImageGroup"></span><br>
                    <span>Number of Video : </span><span id="nbVideoGroup"></span><br>
                </div>
                <div class="groupBody">
                    <input type="text" id="postText" placeholder="Write Post..." />
                    <button id="groupPostText" >Post</button><button >Image</button><button >Video</button>
                    
                    
                </div>
                <div id="postContentDiv" class="groupBoxPost">

                    </div>
                <div class="flexBox">
                <div class="groupRightSideInfo">
                    <h3>All Participants</h3>
                    <div id="groupAllParticipants"></div>
                    <br>
                </div><br>
                </div><br><br>
            </div>
   

            <script>
                $(document).ready(function() {
                    
                    $("#mainSpecificGroup").hide();
                    $('#searchGroupInput').val('');

                    $(document).on("click","button",function(){
                        if(this.id.includes("groupOpen")){
                            var idOfButtonClicked = ($(this).attr('value'));
                            $.post('../../Controller/GroupController/getGroupInfoById.php',{id:idOfButtonClicked},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    $("#mainSpecificGroup").show();
                                    $("#mainGenericGroup").hide();
                                    $("#groupName").text(info[1]['groupheader'][0]['name']);
                                    $("#storeGroupId").val(idOfButtonClicked);
                                    createRightAllParticipantsBox(info[1]['groupParticipant']);
                                    createPostBox(info[1]['groupPostContent']);
                                }
                            });
                        }
                    });


                    function createGroupBox(triggerAction,arrayofEvent){
                        $("#group").empty();
                        $("#group2").append("<h3 style='text-align:center'> "+triggerAction+" </h3>");
                        for(var x = 0; x<arrayofEvent.length;x++ ){
                            var eventHtmlBox = "<div class = 'listOfGroups' > "+
                                                "<span> Group Name : "+arrayofEvent[x]['name']+"</span><br>"+
                                                "<span> Event Name : "+arrayofEvent[x]['eventName']+"</span>";
                                                if(arrayofEvent[x]['isRegistered'] == 0){
                                                    eventHtmlBox +=  "<button id= 'groupRegister' class='groupButton' value='"+arrayofEvent[x]['ID']+"' >Register</button><br>";
                                                }else{
                                                    eventHtmlBox +=  "<button id= 'groupOpen' class='groupButton' value='"+arrayofEvent[x]['ID']+"'>Open</button><br>";
                                                }
                                                
                                                eventHtmlBox +=  "</div>"
                                                
                            $("#group").append(eventHtmlBox);
                        }
                    }

                    function createRightAllParticipantsBox(arrayofAllParticipant){
                        $("#groupAllParticipants").empty();

                        $("#nbParticipantGroup").text(arrayofAllParticipant.length);
                        for(var x = 0; x<arrayofAllParticipant.length;x++ ){
                            var participantHtmlBox = "<div class = 'allParticipantGroup' > "+
                                                "<span> "+(x+1)+")"+arrayofAllParticipant[x]['name']+"</span>";
                                                
                                                participantHtmlBox +=  "</div>"
                                                
                            $("#groupAllParticipants").append(participantHtmlBox);
                        }
                    }

                    function MyGroupBox(arrayOfMyGroups){
                        $("#myGroups").empty();


                        for(var x = 0; x<arrayOfMyGroups.length;x++ ){
                            var groupHtmlBox = "<div class = 'allParticipantGroup' > "+
                                                "<span> "+(x+1)+")"+arrayOfMyGroups[x]['name']+"</span>";
                                                
                                                groupHtmlBox +=  "</div>"
                                                
                            $("#myGroups").append(groupHtmlBox);
                        }
                    }

                    function createPostBox(arrayofPost){
                        $("#postContentDiv").empty();
                        $("#nbPostGroup").text(arrayofPost.length);
                        for(var x = 0; x<arrayofPost.length;x++ ){
                            var postHtmlBox = "<div class = 'userGroupPost'>" +
                                                "<h5>"+arrayofPost[x]['name']+"</h4> "+
                                                "<span> "+arrayofPost[x]['date']+"</span><br><br>"+
                                                "<h4>"+arrayofPost[x]['content']+"</h4><br>"+
                                                "<input id=\"commentPostId"+arrayofPost[x]['ID']+"\" type=text placeholder=\"Comment...\" />"+
                                                "<button id=\"commentPostIdButton"+arrayofPost[x]['ID']+"\">Comment</button>"+
                                                //createCommentBox(arrayofPost[x]['children'])+
                                                "</div>"
                                                
                            $("#postContentDiv").append(postHtmlBox);
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

                    $("#searchGroupButton").click(function(){
                        if($("#searchGroupInput").val() != ""){
                            $.post('../../Controller/GroupController/searchGroup.php',{name:$("#searchGroupInput").val()},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    createGroupBox("All groups you searched for!",info[1]);
                                }else{
                                    createGroupBox("No group for this search !",[]);
                                }
                            });
                        }else{
                            alert("You need to search for a specific group");
                        }
                    });

                    $("#backToSearchGroup").click(function(){
                        $("#mainSpecificGroup").hide();
                        $("#mainGenericGroup").show();

                    });

                    $("#clearButton").click(function(){
                        $.post('../../Controller/GroupController/searchUserGroup.php',{},function(data){
                            var info = JSON.parse(data);
                            if(info[0]){
                                createGroupBox("All groups you can join or are currently in !",info[1]);
                                $('#searchGroupInput').val('');
                            }else{
                                
                            }
                            });                   
                         });

                    $.post('../../Controller/GroupController/searchUserGroup.php',{},function(data){
                        var info = JSON.parse(data);
                            if(info[0]){
                                createGroupBox("All groups you can join or are currently in !",info[1]);
                            }else{
                                
                            }
                    });

                    $.post('../../Controller/GroupController/getMyGroups.php',{},function(data){
                        var info = JSON.parse(data);
                            if(info[0]){
                                MyGroupBox(info[1]);
                            }else{
                                alert("LOL");
                            }
                    });

                    $("#groupPostText").click(function(){
                        if($("#postText").val() != ""){
                            $.post('../../Controller/GroupController/postContent.php',{content:$("#postText").val(),type:"Text",groupID:$("#storeGroupId").val()},function(data){
                                var info = JSON.parse(data);
                                if(info[0]){
                                    alert('How I move');
                                    createPostBox(info[1]['groupPostContent']);
                                }else{
                                }
                            });
                        }
                    });

                });
            </script>
        </body>
    </html>