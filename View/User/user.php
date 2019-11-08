<!DOCTYPE html>
    <html>
        <head>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
            </style>
        </head>
        <body>
        <?php include("../Dashboard/navbar.php") ?>
        <div id="main">
        <span style="font-size:30px;cursor:pointer" id="openNav">&#9776; Menu</span><br>
        <input type="text" id="searchUserInput" placeholder="Search User...">
        <button id="searchUserButton">Search</button>
        <button id="createUserButton">Create</button>
        </div>

            <script>
                $(document).ready(function() {
                   

                });
            </script>
        </body>
    </html>