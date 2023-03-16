<?php


$id = $_GET['userid'];
$username = $_GET['user'];
$gameid = $_GET['gameid'];
require("dependencies/connection.php");

$userSQL = "select * from user where id='{$id}'";
$userRatingSQL = "SELECT ROUND(AVG(rating),2) as realrating FROM `rating` WHERE ratedUser = {$id};";

$queriedUser = mysqli_query($conn, $userSQL);
$queriedUserRating = mysqli_query($conn, $userRatingSQL);


if (mysqli_num_rows($queriedUser) === 1) {
    $row = mysqli_fetch_array($queriedUser);
    $name = $row['nev'];
    $avatar = $row['avatar'] == "" ? "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" : $row['avatar'];
} else {
    array_push($error, "This user doesnt exist");
}

$ratingrow = mysqli_fetch_array($queriedUserRating);
if ($ratingrow['realrating'] != NULL) {
    $rating = $ratingrow['realrating'];
    echo $rating;
} else {
    $rating = "0";
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/profile.css">
    <title>Game2Racker</title>
</head>

<body>
    <?php require("dependencies/navbar.php"); ?>



    <h1 class="name"><?php echo $row['nev']; ?></h1>
    <img class="avatar" src="<?php echo $avatar ?>" alt="">
    <h1 class="rating">Score: <?php echo $rating ?></h1>
    <?php

    if ($userData['userID'] != $id) {
        echo "<div class=\"slidecontainer\">
            <input type=\"range\" min=\"1\" max=\"10\" value=\"\" class=\"slider\" id=\"ratingSlider\">
            <input id=\"submitRate\" type=\"button\" value=\"Rate\">
            </div>";

        echo "<script>
        let range = document.getElementById(\"ratingSlider\");
        let submitRate = document.getElementById(\"submitRate\");

        submitRate.addEventListener('click',() => {
            let dataForPHP = new FormData();
            dataForPHP.append(\"ratedUser\", {$id});
            dataForPHP.append(\"ratedBy\", {$userData['userID']});
            dataForPHP.append(\"rating\", range.value);
    
            fetch(`dependencies/pushRating.php`, {
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
    }

    ?>

    



</body>

</html>