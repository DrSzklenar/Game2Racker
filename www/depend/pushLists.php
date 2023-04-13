<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

require("connection.php");
require("tokenHandler.php");
$result = mysqli_query($conn, $tokenQuery);
$userData = getUserData($result);

// create list

if (isset($_POST['name'])) {
    $listName = htmlspecialchars($_POST['name']);
}
else {
    $listName = null;
}

if (isset($_POST['vis'])) {
    $listVis = $_POST['vis'];
}
else {
    $listVis = null;
}

// add to list


if (isset($_POST['gameID'])) {
    $gameID = htmlspecialchars($_POST['gameID']);
}
else {
    $gameID = null;
}

if (isset($_POST['listID'])) {
    $listID = $_POST['listID'];
}
else {
    $listID = null;
}

if (isset($_POST['gameName'])) {
    $gameName = htmlspecialchars($_POST['gameName']);
}
else {
    $gameName = null;
}

if (isset($_POST['gamePic'])) {
    $gamePic = $_POST['gamePic'];
}
else {
    $gamePic = null;
}


if (isset($_POST['type'])) {
    $type = $_POST['type'];
}
else {
    $type = null;
}




$lastListDate = mysqli_fetch_row(mysqli_query($conn ,"SELECT `updated` FROM `lists` WHERE userID = {$userData['userID']} ORDER BY `updated` desc LIMIT 1"));
function Did5SecondsPass($lastListDate){
    if (date("Y-m-d H:i:s",strtotime($lastListDate['0']) + 3) < date("Y-m-d H:i:s")) {
        return true;
    }
    else {
        return false;
    }
}

if (isset($type) && $type == "create") {
    if ($userData != false && isset($listName) && isset($listVis) && Did5SecondsPass($lastListDate) && ($listVis == 1 || $listVis == 0)) {
        $pushListSQL = "INSERT INTO `lists`(`userID`, `nev`, `visibility`) VALUES (?,?,?)";
        $stmt = $conn->prepare($pushListSQL);
        $stmt->bind_param('isi', $userData['userID'],$listName,$listVis);
        $stmt->execute();
        echo "INSERTED";
    }
    else {
        echo "Mit csinálsz te gatya fejű";
    }
}
else if (isset($type) && $type == "add") {
    if ($userData != false) {
        $isListTheUsersSQL = "SELECT * FROM `lists` WHERE userID = {$userData['userID']} AND id = {$listID};";
        $GameExistsSQL = "SELECT * FROM `listGames` WHERE gameID = {$gameID} and listID = {$listID};";
        if (mysqli_num_rows(mysqli_query($conn, $isListTheUsersSQL)) > 0 && mysqli_num_rows(mysqli_query($conn, $GameExistsSQL)) == 0) {
            $pushListGamesSQL = "INSERT INTO `listGames`(`listID`, `gameID`, `name`, `picture`) VALUES (?,?,?,?);";
            $stmt = $conn->prepare($pushListGamesSQL);
            $stmt->bind_param('iiss',$listID,$gameID,$gameName,$gamePic);
            $stmt->execute();
            
            echo "INSERTED";
        }
        else {
            echo "Mit csinálsz te gatya fejű";
        }
        
    }
    else {
        echo "Mit csinálsz te gatya fejű";
    }
    
}
else {
    echo "Mit csinálsz te gatya fejű";
}


?>