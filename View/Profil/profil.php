<!DOCTYPE html>
    <html>
        <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
            <title>Soul Society</title>
            <style>
            #userProfilBox {
                margin-top :10%;
                margin-left : 25%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                width: 30%;
                
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
                #editUser {background-color: #4CAF50; /* Green */
                            }
            </style>
        </head>
        <body>
        <?php include("../Dashboard/navbar.php") ?>
        <div id="main">
        <span style="font-size:30px;cursor:pointer" id="openNav">&#9776; Menu</span>
            <div id ="userProfilBox" >
                <p> Firstname : <span id="userFirstname"></span></p>
                <p> Lastname : <span id="userLastname"></span></p>
                <p> Username  : <span id="userUsername"></span></p>
                <p> Birthday  : <span id="userBirthday"></span></p>
                <button id="editUser" data-toggle="modal" data-target="#myModal">Edit</button>
            </div>
            
            
        </div>
        <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Profil</h4>
                    </div>
                    <div class="modal-body">
                    <span> Firstname :</span> <input type="text" id="firtnameEdit" ><br>
                    <span> Lastname :</span> <input type="text" id="lastnameEdit" ><br>
                    <span> Username :</span> <span id="usernameEdit" ></span><br>
                    <span> Birthday :</span> <span  id="birthdayEdit" ></span><br>
                    </div>
                    <div class="modal-footer">
                    <button type="button" id="saveUser" class="btn btn-default" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                
                </div>
            </div>
        

            <script>
                $(document).ready(function() {
                   
                    $.post('../../Controller/UserController/getUserInformation.php',{},function(data){
                            var info = JSON.parse(data);
                            if(info[0]){
                                $("#userFirstname").text(info[1]["firstname"]);
                                $("#userLastname").text(info[1]["lastname"]);
                                $("#userUsername").text(info[1]["username"]);
                                $("#userBirthday").text(info[1]["BirthDate"]);

                                //for modal
                                $("#firtnameEdit").val(info[1]["firstname"]);
                                $("#lastnameEdit").val(info[1]["lastname"]);
                                $("#usernameEdit").text(info[1]["username"]);
                                $("#birthdayEdit").text(info[1]["BirthDate"]);
                            }else{

                            }
                        });
                    
                    $("#saveUser").click(function(){
                        if($("#firtnameEdit").val() == "" || $("#lastnameEdit").val() == ""){
                            alert("All fields must be field");
                        }else{
                            $.post('../../Controller/UserController/editInformation.php',{firstname:$("#firtnameEdit").val(),lastname:$("#lastnameEdit").val()},function(data){
                            var info = JSON.parse(data);
                            if(info[0]){
                                window.location.href="profil.php";
                            }else{

                            }
                        });
                        }
                    });

                });
            </script>
        </body>
    </html>