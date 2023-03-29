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
$type = $_POST["type"];
if (isset($_POST["text"])) {
    $text = $_POST["text"];
}
else {
    $text = null;
}

if (isset($_POST["ratio"])) {
    $ratio = $_POST["ratio"];
}
else {
    $ratio = null;
}



$lastCommentDate = mysqli_fetch_row(mysqli_query($conn ,"SELECT date FROM `comment` WHERE madeBy = {$userData['userID']} ORDER BY date desc LIMIT 1"));

function Did5SecondsPass($lastCommentDate){
    if (date("Y-m-d H:i:s",strtotime($lastCommentDate['0']) + 3) < date("Y-m-d H:i:s")) {
        return true;
    }
    else {
        return false;
    }
}

$cleanText = htmlspecialchars($text);
if (isset($type) && ($type == "user" || $type == "game")) {
    if (isset($text) && $userData != false && Did5SecondsPass($lastCommentDate) && isset($madeOn)) {
        $pushSQL = "INSERT INTO `comment`(`madeBy`, `madeOn`, `type`, `text`) VALUES ('{$userData['userID']}','{$madeOn}','{$type}','{$cleanText}');";
        mysqli_query($conn, $pushSQL);
        echo "NOPLIZ";
    }
    else {
        echo "GANTZ";
    }
}
else if (isset($type) && $type == "vote") {
    if (isset($type) && $type == "vote" && $userData != false && isset($ratio) && ($ratio <= 1 && $ratio >= -1) && isset($madeOn)) {
        $voteSQL = "SELECT * FROM `ratios` WHERE  commentID = {$madeOn} AND userID = {$userData['userID']}";
        $queriedVote = mysqli_query($conn, $voteSQL);
        if (mysqli_num_rows($queriedVote) == 0) {
            $pushSQL = "INSERT INTO `ratios`(`commentID`, `userID`, `ratio`) VALUES ('{$madeOn}','{$userData['userID']}','$ratio')";
            mysqli_query($conn, $pushSQL);
            echo "INSERTED NEW ROW";
        }
        else {
            $pushSQL = "UPDATE `ratios` SET `ratio`='{$ratio}',`date`= CURRENT_TIMESTAMP WHERE commentID = '{$madeOn}' AND userID = '{$userData['userID']}'";
            mysqli_query($conn, $pushSQL);
            echo $ratio;
        }
    }
}
else if (isset($type) && $type == "delete") {
    if (isset($madeOn) && $userData != false) {
        $deleteCommentSQL = "DELETE `comment`, ratios FROM `ratios` RIGHT JOIN comment ON comment.id = ratios.commentID WHERE comment.id = '{$madeOn}'  AND (comment.madeBy = '{$userData['userID']}' OR comment.madeOn = '{$userData['userID']}')";
        mysqli_query($conn, $deleteCommentSQL);
        echo "DELETED";
    }
    else {
        echo "Mit csinálsz te gatya fejű";
    }

}



?>