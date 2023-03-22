<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");


require("connection.php");


$ratedThing = $_POST["ratedThing"];
$ratedBy = $_POST["ratedBy"];
$rating = $_POST["rating"];
$type = $_POST["type"];


if (isset($type) && $type == "user") {
    
    if (isset($ratedThing) && isset($ratedBy) && isset($rating)) {
        $userRatingSQL = "SELECT * FROM `ratingUser` WHERE  ratedUser = {$ratedThing} AND ratedBy = {$ratedBy}";
        $queriedUserRating = mysqli_query($conn, $userRatingSQL);
        echo $ratedThing;
        echo $ratedBy;
        echo mysqli_num_rows($queriedUserRating);
    
        if (mysqli_num_rows($queriedUserRating) == 0) {
            $pushSQL = "INSERT INTO `ratingUser`(`ratedUser`, `ratedBy`, `rating`) VALUES ('{$ratedThing}','{$ratedBy}','{$rating}');";
            mysqli_query($conn, $pushSQL);
            echo "INSERTED NEW ROW";
        }
        else {
            $pushSQL = "UPDATE `ratingUser` SET `rating`='$rating' WHERE ratedUser = '{$ratedThing}' AND ratedBy = '{$ratedBy}'";
            mysqli_query($conn, $pushSQL);
            echo "UPDATED";
        }
    
        
    }
}
else if (isset($type) && $type == "game") {
    if (isset($ratedThing) && isset($ratedBy) && isset($rating)) {
        $gameRatingSQL = "SELECT * FROM `ratingGame` WHERE  ratedGame = {$ratedThing} AND ratedBy = {$ratedBy}";
        $queriedGameRating = mysqli_query($conn, $gameRatingSQL);
        echo $ratedThing;
        echo $ratedBy;
        echo mysqli_num_rows($queriedGameRating);
    
        if (mysqli_num_rows($queriedGameRating) == 0) {
            $pushSQL = "INSERT INTO `ratingGame`(`ratedGame`, `ratedBy`, `rating`) VALUES ('{$ratedThing}','{$ratedBy}','{$rating}');";
            mysqli_query($conn, $pushSQL);
            echo "INSERTED NEW ROW";
        }
        else {
            $pushSQL = "UPDATE `ratingGame` SET `rating`='$rating' WHERE ratedGame = '{$ratedThing}' AND ratedBy = '{$ratedBy}'";
            mysqli_query($conn, $pushSQL);
            echo "UPDATED";
        }
    
        
    }
    
}



?>