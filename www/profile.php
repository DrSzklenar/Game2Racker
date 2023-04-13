<?php


$userid = $_GET['userid'];
$username = $_GET['user'];

require("depend/connection.php");


$userSQL = "SELECT * FROM `users` WHERE id='{$userid}'";
$queriedUser = mysqli_query($conn, $userSQL);
if (mysqli_num_rows($queriedUser) === 1) {
    $row = mysqli_fetch_array($queriedUser);
    $name = $row['nev'];
    $avatar = $row['avatar'] == "" ? "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" : $row['avatar'];
} else {
    array_push($error, "This user doesnt exist");
}

$listQuery = 'f game.id, game.name,url,game.first_release_date,game.summary,game.platforms.slug,game.platforms.name,game.genres.name,game.involved_companies.company.name,game.videos.video_id,game.game_modes.name; where id =' . $id . '; l 1;';



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


    <section class="profile-main">
        <div class="profile-section">
            <div class="profile-picture">
                <img class="avatar" src="<?php echo $avatar ?>" alt="">
            </div>
            <div class="profile-texts">
                <h1 class="name"><?php echo $row['nev']; ?></h1>
                <?php require("depend/rating.php"); ?>
            </div>
                <?php
                
              
                        if ($row['steam'] != "") {
                            echo "<div class=\"steamurl\">
                        <a href=\"{$row['steam']}\" target = \"_blank\"></a>
                        </div>";
                        }
                   
                            
                
                
                
               
                    
                    ?>
        </div>
        <div class="lists-section flexcol">
                <?php
                
                $queryUsersLists = "SELECT `lists`.id,`lists`.`userID`,`lists`.`nev`,`lists`.`type`,`lists`.`visibility`,`lists`.`order`,`lists`.`updated` FROM `lists` RIGHT JOIN `listGames` ON `lists`.id = `listGames`.listID WHERE `lists`.`userID` = '{$userid}' GROUP BY `lists`.`id`;";
                $allListsUser = mysqli_query($conn,$queryUsersLists);
                while($list = mysqli_fetch_assoc($allListsUser)) {
                    $allGamesInListSQL = "SELECT * FROM `listGames` WHERE listID = {$list['id']};";
                    $allGamesInList = mysqli_query($conn,$allGamesInListSQL);
                    echo "<div id=\"{$list['id']}\" class=\"list-item\"><h1 class=\"lists-name\">{$list['nev']}</h1> <div class=\"wrapper container card-content\">";

                    while ($games = mysqli_fetch_array($allGamesInList)) {
                        
                        echo "<div class=\"card\" >
                            <div class=\"card-header\">
                            
                                <h3 class=\"name\">" . $games['name'] . "</h3>
                            </div>
                            <div class=\"card-body\">
                                <img loading=\"lazy\" src=\"". $games['picture'] ."\">
                            </div>
                        </div>";   
                    }


                    echo "</div></div>";
                    
                    
                }
                            
                ?>
            
        </div>
    </section>

    <?php require("depend/comments.php"); ?>

    <?php require("depend/footer.php"); ?>
</body>
</html>