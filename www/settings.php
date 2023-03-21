<?php

$id = $_GET['userid'];
$username = $_GET['user'];
$gameid = $_GET['gameid'];
require("dependencies/connection.php");


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
    <?php require("dependencies/navbar.php");
    
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
            
            <script>
            let picUrl = document.getElementById(\"pictureUrl\");
            let sendSettings = document.getElementById(\"sendSettings\");

            sendSettings.addEventListener('click',() => {
                let dataForPHP = new FormData();
                dataForPHP.append(\"userID\", {$id});
                dataForPHP.append(\"picUrl\", picUrl.value);
        
                fetch(`dependencies/pushSettings.php`, {
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
            
                    fetch(`dependencies/pushSettings.php`, {
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