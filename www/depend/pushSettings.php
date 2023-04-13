<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");


require("connection.php");
require("tokenHandler.php");

$result = mysqli_query($conn, $tokenQuery);



$userID = $_POST["userID"];


if (isset($_POST['picUrl'])) {
    $picUrl = htmlspecialchars($_POST['picUrl']);
}
else {
    $picUrl = null;
}

if (isset($_POST['steamUrl'])) {
    $steamUrl = htmlspecialchars($_POST['steamUrl']);
}
else {
    $steamUrl = null;
}

if (isThereValidToken($result) && isset($userID) && isset($picUrl)) {
    $pushSQL = "UPDATE `users` SET `avatar`= ? WHERE id = ?;";
    $stmt = $conn->prepare($pushSQL);
    $stmt->bind_param('si', $picUrl,$userID);
    $stmt->execute();
    $stmt->reset();
    echo "UPDATED";   
}

if (isThereValidToken($result) && isset($userID) && isset($steamUrl) && (preg_match('/\bhttps:\/\/steamcommunity.com\/id\b/', $steamUrl) || $steamUrl = "")) {
    $pushSQL = "UPDATE `users` SET `steam`= ? WHERE id = ?;";
    $stmt = $conn->prepare($pushSQL);
    $stmt->bind_param('si', $steamUrl,$userID);
    $stmt->execute();
    $stmt->reset();
    echo "UPDATED";   
}


?>