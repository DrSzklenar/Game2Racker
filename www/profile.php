<?php


$userid = $_GET['userid'];
$username = $_GET['user'];
require("depend/connection.php");


$userSQL = "select * from user where id='{$userid}'";
$queriedUser = mysqli_query($conn, $userSQL);
if (mysqli_num_rows($queriedUser) === 1) {
    $row = mysqli_fetch_array($queriedUser);
    $name = $row['nev'];
    $avatar = $row['avatar'] == "" ? "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" : $row['avatar'];
} else {
    array_push($error, "This user doesnt exist");
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Game2Racker</title>
</head>
<body>
    <?php require("depend/navbar.php"); ?>


    <div class="profilemain">
        <div class="profilePicture">
            <img class="avatar" src="<?php echo $avatar ?>" alt="">
        </div>
        <div class="profiletexts">
            <h1 class="name"><?php echo $row['nev']; ?></h1>
            <?php require("depend/rating.php"); ?>
        </div>
    </div>

    <?php require("depend/comments.php"); ?>

    <?php require("depend/footer.php"); ?>
</body>
</html>