<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <title>Soul Society</title>
            <style>
            #searchGroupInput {
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
                #searchGroupButton {
                width: 5%;
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
                margin-left : 25%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 30%;
                box-shadow: 5px 10px #888888;
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
          
            </style>
        </head>
        <body>
        <?php include("../Dashboard/navbar.php") ?>

        <div id="main">
            <div id="mainGenericGroup">
            <span style="font-size:30px;cursor:pointer" id="openNav">&#9776; Menu</span><br>
            <input type="text" id="searchGroupInput" placeholder="Search Group...">
            <button id="searchGroupButton">Search</button>
            <div id="group" ></div>
             </div>
   

            <script>
                $(document).ready(function() {
                   

                    


                
                    function createGroupBox(triggerAction,arrayofEvent){
                        $("#group").empty();
                        $("#group").append("<h3 style='margin-left:25%'> "+triggerAction+" </h3>");
                        for(var x = 0; x<arrayofEvent.length;x++ ){
                            var eventHtmlBox = "<div class = 'listOfGroups' > "+
                                                "<span> Group Name : "+arrayofEvent[x]['name']+"</span>";
                                                if(arrayofEvent[x]['isRegistered'] == 0){
                                                    eventHtmlBox +=  "<button id= \"groupRegister"+arrayofEvent[x]['ID']+"\" class='groupButton'  >Register</button><br>";
                                                }else{
                                                    eventHtmlBox +=  "<button id= \"groupOpen"+arrayofEvent[x]['ID']+"\" class='groupButton'>Open</button><br>";
                                                }
                                                
                                                eventHtmlBox +=  "</div>"
                                                
                            $("#group").append(eventHtmlBox);
                        }
                    }
                   


                    $.post('../../Controller/GroupController/searchUserGroup.php',{},function(data){
                            var info = JSON.parse(data);
                            if(info[0]){
                                createGroupBox("All Group you can register or registered in !",info[1]);
                            }else{
                                
                            }
                        });
                });
            </script>
        </body>
    </html>