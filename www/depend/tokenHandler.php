<?php
// minden amihez felhaszáló autentikáció szükséges ezt a filet használja. A legtöbb oldalon ez a navbarban történik.

$queryAll = "UPDATE `sessions` SET `active`='0' WHERE expires < '".date("Y-m-d H:i:s")."'";
mysqli_query($conn, $queryAll);
// Ez a lekérdezés invalidálja az összes lejárt tokent


$tokenQuery = "
SELECT 
`users`.id,`users`.nev,`users`.avatar,`users`.email,`sessions`.id,`sessions`.userID,`sessions`.active,`sessions`.token,`sessions`.acquired,`sessions`.expires
FROM `users` RIGHT JOIN `sessions` on `sessions`.userID = `users`.id
WHERE `sessions`.token = '{$_COOKIE["session"]}'
AND active = '1'
";

$result = mysqli_query($conn, $tokenQuery);
// Ez a lekérdezés megnézi hogy létezik e olyan sor az adatbázisban amiben a token egyezik a belépéskor beállított cookieval

function getUserData($result){
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_array($result);
    }
    else {
        return array();
    }
}
//ha van akkor visszaküldi az adatokat a function, egyébként üres tömböt küld


?>