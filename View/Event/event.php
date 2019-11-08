<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
            </style>
        </head>
        <body>
        <?php include("../Dashboard/navbar.php") ?>
        <div id="main">
            <span style="font-size:30px;cursor:pointer" id="openNav">&#9776; Menu</span><br>
            <input type="text" id="searchEventInput" placeholder="Search Event...">
            <button id="searchEventButton">Search</button>
            <button id="createEventButton" data-toggle="modal" data-target="#myModal">Create</button>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Event</h4>
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
                    $("#saveEvent").click(function(){
                        if($("#nameEvent").val() == ""||$("#addressEvent").val() == ""||$("#phoneNumberEvent").val() == ""||$("#typeOfOrgEvent").val() == ""){
                            alert("All fields must be field");
                        }else{
                            $.post('../../Controller/EventController/createEvent.php',{name:$("#nameEvent").val(),address:$("#addressEvent").val(),phone:$("#phoneNumberEvent").val(),type:$("#typeOfOrgEvent").val()},function(data){
                            var info = JSON.parse(data);
                            if(info[0]){
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