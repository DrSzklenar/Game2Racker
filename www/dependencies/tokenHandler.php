<?php

$tokenQuery = "SELECT * FROM `user` right JOIN sessions on sessions.userID = user.id WHERE sessions.token = '".$_COOKIE['session']."';";

$result = mysqli_query($conn, $tokenQuery);

function isThereValidToken($result){
    if (mysqli_num_rows($result) === 1) {
        echo "True et";
        return true;
    } else {
        return false;
        echo "False et";
    }
    return false;
}

function getUserData($result){
    if (isThereValidToken(($result))) {
        echo $ehoe = mysqli_fetch_array($result);
        return mysqli_fetch_array($result);
    }
    else {
        echo "error";
        return $error[] = 'ERROR ERROR';
    }

}



?>