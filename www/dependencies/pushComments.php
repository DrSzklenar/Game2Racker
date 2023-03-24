<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");


require("connection.php");
require("tokenHandler.php");
$result = mysqli_query($conn, $tokenQuery);
$userData = getUserData($result);

$madeOn = $_POST["madeOn"];
$text = $_POST["text"];
$type = $_POST["type"];


if (isset($type) && $type == "user" && $userData != false) {
    
    if (isset($madeOn) && isset($text)) {
        $pushSQL = "INSERT INTO `comment`(`madeBy`, `madeOn`, `type`, `text`) VALUES ('{$userData['nev']}','{$madeOn}','{$type}','{$text}');";
        mysqli_query($conn, $pushSQL);
        echo "INSERTED NEW ROW";
    }
}
// else if (isset($type) && $type == "game") {
//     if (isset($ratedThing) && isset($ratedBy) && isset($rating)) {
//         $gameRatingSQL = "SELECT * FROM `ratingGame` WHERE  ratedGame = {$ratedThing} AND ratedBy = {$ratedBy}";
//         $queriedGameRating = mysqli_query($conn, $gameRatingSQL);
//         echo $ratedThing;
//         echo $ratedBy;
//         echo mysqli_num_rows($queriedGameRating);
    
//         if (mysqli_num_rows($queriedGameRating) == 0) {
//             $pushSQL = "INSERT INTO `ratingGame`(`ratedGame`, `ratedBy`, `rating`) VALUES ('{$ratedThing}','{$ratedBy}','{$rating}');";
//             mysqli_query($conn, $pushSQL);
//             echo "INSERTED NEW ROW";
//         }
//         else {
//             $pushSQL = "UPDATE `ratingGame` SET `rating`='$rating' WHERE ratedGame = '{$ratedThing}' AND ratedBy = '{$ratedBy}'";
//             mysqli_query($conn, $pushSQL);
//             echo "UPDATED";
//         }
    
        
//     }
    
// }



?>