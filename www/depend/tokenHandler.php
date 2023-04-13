<?php
$queryAll = "UPDATE `sessions` SET `active`='0' WHERE expires < '".date("Y-m-d H:i:s")."'";

mysqli_query($conn, $queryAll);


$tokenQuery = "
SELECT 
`users`.id,`users`.nev,`users`.avatar,`users`.email,`sessions`.id,`sessions`.userID,`sessions`.active,`sessions`.token,`sessions`.acquired,`sessions`.expires
FROM `users` RIGHT JOIN `sessions` on `sessions`.userID = `users`.id
WHERE `sessions`.token = '{$_COOKIE["session"]}'
AND active = '1'
";


/*
//1. eset ez a mostani megoldás: 
//ha igaz:
$userData = array(...);
//ha hamis
$userData = false (boolean);

//2. erre lehetne dosni: 
//ha igaz:
$userData = array(userdata));
//ha hamis
$userData = array(ürestömb)
*/

$result = mysqli_query($conn, $tokenQuery);




function isThereValidToken($result){
    if (mysqli_num_rows($result) === 1) {
        return true;
    } else {
        return false;
    }
    return false;
}

function getUserData($result){
    if (isThereValidToken(($result))) {
        return mysqli_fetch_array($result);
    }
    else {
        return array();
    }
}



?>