<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");


require("connection.php");
require("tokenHandler.php");

$result = mysqli_query($conn, $tokenQuery);

$userID = $_POST["userID"];
$picUrl = $_POST["picUrl"];

if (isThereValidToken($result) && isset($userID) && isset($picUrl)) {

    $pushSQL = "UPDATE `user` SET `avatar`='{$picUrl}' WHERE id = {$userID};";
    mysqli_query($conn, $pushSQL);
    echo "UPDATED";   
}


?>