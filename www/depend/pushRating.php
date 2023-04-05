<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");

require("connection.php");
require("tokenHandler.php");
$result = mysqli_query($conn, $tokenQuery);
$userData = getUserData($result);


$ratedThing = $_POST["ratedThing"];
$ratedBy = $_POST["ratedBy"];
$rating = $_POST["rating"];
$type = $_POST["type"];

if (isset($type)) {
    if (isset($ratedThing) && isset($ratedBy) && isset($rating) && $userData != false) {
        $RatingSQL = "SELECT * FROM `ratingTable` WHERE  ratedThing = {$ratedThing} AND ratedBy = {$userData['userID']} AND type = '{$type}'";
        $queriedRating = mysqli_query($conn, $RatingSQL);
        echo $ratedThing;
        echo mysqli_num_rows($queriedRating);
    
        if (mysqli_num_rows($queriedRating) == 0) {
            $pushSQL = "INSERT INTO `ratingTable`(`ratedThing`, `ratedBy`,`type`,`rating`) VALUES ('{$ratedThing}','{$userData['userID']}','{$type}','{$rating}');";
            mysqli_query($conn, $pushSQL);
            echo "INSERTED NEW ROW";
        }
        else {
            $pushSQL = "UPDATE `ratingTable` SET `rating`='$rating' WHERE ratedThing = '{$ratedThing}' AND ratedBy = '{$userData['userID']}' AND type = '{$type}'";
            mysqli_query($conn, $pushSQL);
            echo "UPDATED";
        }    
    }
}
?>