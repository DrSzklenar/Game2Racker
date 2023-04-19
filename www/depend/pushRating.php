<?php
// ezt a filet a rating.php hívja egy php fetch-el post metódussal adja át az adatokat, a file nem fog működni ha a felhasználó a hozzáférési útján akarja elérni 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");

require("connection.php");
require("tokenHandler.php");

$ratedThing = $_POST["ratedThing"];
$rating = $_POST["rating"];
$type = $_POST["type"];

if (isset($type) && (isset($ratedThing) && $ratedThing != $userData['userID']) && (isset($rating) && $rating > 0 && $rating <= 10) && !empty($userData)) {
    $RatingSQL = "SELECT * FROM `ratingTable` WHERE  ratedThing = {$ratedThing} AND ratedBy = {$userData['userID']} AND type = '{$type}'";
    $queriedRating = mysqli_query($conn, $RatingSQL);
    echo $ratedThing;
    echo mysqli_num_rows($queriedRating);
    // a lekérdezésben megkapjuk hogy ezt az adott dolgot értékelte már e a felhasználó 
    if (mysqli_num_rows($queriedRating) == 0) {
        $pushSQL = "INSERT INTO `ratingTable`(`ratedThing`, `ratedBy`,`type`,`rating`) VALUES ('{$ratedThing}','{$userData['userID']}','{$type}','{$rating}');";
        mysqli_query($conn, $pushSQL);
        echo "INSERTED NEW ROW";
    }
    // ha még nem akkor be kerül az új sor az aadatbázisba
    else {
        $pushSQL = "UPDATE `ratingTable` SET `rating`='$rating' WHERE ratedThing = '{$ratedThing}' AND ratedBy = '{$userData['userID']}' AND type = '{$type}'";
        mysqli_query($conn, $pushSQL);
        echo "UPDATED";
    } 
    // ha már értékelte akkor frissíti a sort.
}
// Ha nincsenek meg a szükséges paraméterek amiket a file post metódussal kap meg , a tokenhandler userdatája üres akkor nem fut le ez az oldal
//és azt hogy a küldött értékelés 1-10 között van ittetve a felhasználó nem magát szeretné értékelni ha esetleg kiskaput keresne és meghívná ezt az oldalt egy fetch-el custom paraméterekkel

?>