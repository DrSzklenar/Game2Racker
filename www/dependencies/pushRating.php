<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");


require("connection.php");


$ratedUser = $_POST["ratedUser"];
$ratedBy = $_POST["ratedBy"];
$rating = $_POST["rating"];

if (isset($ratedUser) && isset($ratedBy) && isset($rating)) {
    $userRatingSQL = "SELECT ROUND(AVG(rating),2) as realrating FROM `rating` WHERE ratedUser = {$ratedUser}; AND ratedBy = {$ratedby}";
    $queriedUserRating = mysqli_query($conn, $userRatingSQL);

    if (mysqli_num_rows($queriedUserRating) === 0) {
        $pushSQL = "INSERT INTO `rating`(`ratedUser`, `ratedBy`, `rating`) VALUES ('{$ratedUser}','{$ratedBy}','{$rating}');";
        mysqli_query($conn, $pushSQL);
    }
    else {
        $pushSQL = "UPDATE `rating` SET `rating`='$rating' WHERE ratedUser = '{$ratedUser}' AND ratedBy = '{$ratedBy}'";
        mysqli_query($conn, $pushSQL);
    }

    
    echo "SIKERULT";
}


?>