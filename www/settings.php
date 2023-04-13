<?php

$id = $_GET['userid'];
$username = $_GET['user'];
$gameid = $_GET['gameid'];
require("depend/connection.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/settings.css">
    <title>Document</title>
</head>
<body>
    <?php require("depend/navbar.php");
    
        $html = "";

        if ($id == $userData['userID']) {
            $html = "
            <form action=\"\">
            <div class=\"Text\">
            <h1>Upload a profile picture</h1>
            <div id=\"informamos\">
            <img src=\"https://www.mysafetysign.com/img/lg/I/tourist-information-symbol-iso-sign-is-1293.png\" alt=\"\" id=\"informamosA\">
            </div>
            
            </div>

            
            <input type=\"url\" name=\"Url\" id=\"pictureUrl\">
            <input type=\"button\" value=\"Set\" id=\"sendSettings\">
    
            </form>

            <form action=\"\">
            <div class=\"Text\">
            <h1>Set your steam profile link</h1>
            
            </div>

            <input type=\"url\" name=\"Url\" id=\"steamUrl\">
            <input type=\"button\" value=\"Set\" id=\"sendSettingsSteam\">
    
            </form>


            
            <script>
            let picUrl = document.getElementById(\"pictureUrl\");
            let sendSettings = document.getElementById(\"sendSettings\");

            sendSettings.addEventListener('click',() => {
                let dataForPHP = new FormData();
                dataForPHP.append(\"userID\", {$id});
                dataForPHP.append(\"picUrl\", picUrl.value);
        
                fetch(`depend/pushSettings.php`, {
                        method: \"POST\",
                        body: dataForPHP
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => console.log(error));
                    console.log(\"gag\");
                
            });
            let steamUrl = document.getElementById(\"steamUrl\");
            let sendSettingsSteam = document.getElementById(\"sendSettingsSteam\");

            sendSettingsSteam.addEventListener('click',() => {
                let dataForPHP = new FormData();
                dataForPHP.append(\"userID\", {$id});
                dataForPHP.append(\"steamUrl\", steamUrl.value);
        
                fetch(`depend/pushSettings.php`, {
                        method: \"POST\",
                        body: dataForPHP
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => console.log(error));
                    console.log(\"gag\");
                
            });


        </script>";
        echo $html;

        }
        else {
            $html = "you shouldnt be here";
            echo $html;
        }


    ?>
    

   
<!-- 
    <script>
                let picUrl = document.getElementById("pictureUrl");
                let sendSettings = document.getElementById("sendSettings");

                sendSettings.addEventListener('click',() => {
                    let dataForPHP = new FormData();
                    dataForPHP.append("userID", {$id});
                    dataForPHP.append("picUrl", picUrl.value);
            
                    fetch(`depend/pushSettings.php`, {
                            method: "POST",
                            body: dataForPHP
                        })
                        .then(response => response.text())
                        .then(data => {
                            console.log(data);
                        })
                        .catch(error => console.log(error));
                        console.log("gag");
                    
                });
            </script> -->
</body>
</html>