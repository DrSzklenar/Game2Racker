<?php
session_start();

if(isset($_POST['rendben'])){
    //változók tisztítása
    require("../kapcsolat.php");

    $email =mysqli_real_escape_string($dbconn, strip_tags(strtolower(trim($_POST['email']))));
    $jelszo = sha1($_POST['jelszo']);

    if(empty($email) || 
    !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $hiba = "Hibás e-mail-t, vagy jelszót adtál meg!";
    }

    //beléptetés
    else{
        $sql = "SELECT id
                FROM felhasznalo
                WHERE email = '{$email}'
                AND jelszo = '{$jelszo}'
                LIMIT 3";
        $eredmeny = mysqli_query($dbconn, $sql);

        if(mysqli_num_rows($eredmeny) == 1){
            $_SESSION['belepett'] = true;
            header("Location: lista.php");
        }else{
            $hiba = "Hibás e-mail címet vagy jelszót adott meg!" ;
        }
    }
}



?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="../css/admincss.css">
<title>Magyar Football Alkalmazás</title>
</head>
<body>

<div id="kep"></div>

<form method="post" action="" id="belepesform">
    <!--hiba listát-->
    <?php if(isset($hiba)) print $hiba; ?>
    <h1>Admin felület belépés</h1>
    <p><label for="email">E-mail</label>
    <input type="email" name="email" id="email" required></p>
    <br>

    <p>
        <label for="password">Jelszó</label>
        <input type="password" name="jelszo" id="jelszo">
    </p>
    <br>

    <input type="submit" value="Belépés" id="rendben" name="rendben">

</form>

</body>
</html>