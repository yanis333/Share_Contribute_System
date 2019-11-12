<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <title>Soul Society</title>
            <style>
            #searchUserInput {
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
                #searchUserButton {
                width: 5%;
                background-color: #1F11F7;
                color: white;
                padding: 14px 20px;
                border: none;
                border-radius: 12px;
                cursor: pointer;
                margin-left:1%;
                }

                #searchUserButton:hover {
                background-color: #1006A6;
                }
                #createUserButton {
                width: 5%;
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                border: none;
                border-radius: 12px;
                cursor: pointer;
                margin-left:1%;
                }

                #createUserButton:hover {
                background-color: #45a049;
                }
                .userGroup{
                margin-top :2%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 90%;
                
                }
                .userButton{
                    float:right;
                }
                #UserSearched{
                    width : 45%;
                    margin-left:20%
                }
            </style>
        </head>
        <body>
        <?php include("../Dashboard/navbar.php") ?>
        <div id="main">
        <span style="font-size:30px;cursor:pointer" id="openNav">&#9776; Menu</span><br>
        <input type="text" id="searchUserInput" placeholder="Search User...">
        <button id="searchUserButton">Search</button>
        <button id="createUserButton">Create</button>
        <div id="UserSearched">

        </div>

            <script>
                $(document).ready(function() {


                    function createUserBox(arrayofUser){
                        $("#UserSearched").empty();
                        for(var x = 0; x<arrayofUser.length;x++ ){
                            var userHtmlBox = "<div class = 'userGroup'> "+
                                                "<span> User Name : "+arrayofUser[x]['name']+"</span>"+
                                                "<button id= \"DeleteUserId"+x+"\" class='userButton'>Delete</button>"+
                                                "<button id= \"EditUserId"+x+"\" class='userButton'>Edit</button>"+
                                                "<button id= \"MessageUserId"+x+"\" class='userButton'>Message</button>"
                                                userHtmlBox += "</div>"
                                                
                            $("#UserSearched").append(userHtmlBox);
                        }
                    }


                    $("#searchUserButton").click(function(){
                        if($("#searchUserInput").val() != ""){
                            $.post('../../Controller/UserController/searchUser.php',{name:$("#searchUserInput").val()},function(data){
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

                });
            </script>
        </body>
    </html>