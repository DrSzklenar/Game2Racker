<?php


$userid = $_GET['userid'];
$username = $_GET['user'];

require("depend/connection.php");


$isUserExists = false;

$userSQL = "SELECT `id`, `nev`, `avatar`, `email`, `steam` FROM `users` WHERE `id` = ?";
$stmt = $conn->prepare($userSQL);
$stmt->bind_param('s', $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $profileData = $result->fetch_assoc();
    $isUserExists = true;
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


    <?php if ($isUserExists) { ?>
        <section class="profile-main">
            <div class="profile-section">
                <div class="profile-picture">
                    <img class="avatar" src="<?php echo $profileData['avatar'] ?>" alt="">
                </div>
                <div class="profile-texts">
                    <h1 class="name"><?php echo $profileData['nev']; ?></h1>
                    <?php require("depend/rating.php"); ?>
                </div>
                <?php
                if ($profileData['steam'] != "") {
                    echo "<div class=\"steamurl\">
                            <a href=\"{$profileData['steam']}\" target = \"_blank\"></a>
                            </div>";
                }
                ?>
            </div>
            <div class="lists-section flexcol">
                <div id="lists-opener"><?php echo $profileData['nev'] ?>'s Lists</div>
                <?php

                $queryUsersLists = "SELECT `lists`.id,`lists`.`userID`,`lists`.`nev`,`lists`.`type`,`lists`.`visibility`,`lists`.`order`,`lists`.`updated` FROM `lists` RIGHT JOIN `listGames` ON `lists`.id = `listGames`.listID WHERE `lists`.`userID` = '{$userid}'  AND `lists`.`visibility` = 1 GROUP BY `lists`.`id`;";
                if ($userData['userID'] == $userid) {
                    $queryUsersLists = "SELECT `lists`.id,`lists`.`userID`,`lists`.`nev`,`lists`.`type`,`lists`.`visibility`,`lists`.`order`,`lists`.`updated` FROM `lists` RIGHT JOIN `listGames` ON `lists`.id = `listGames`.listID WHERE `lists`.`userID` = '{$userid}' GROUP BY `lists`.`id`;";
                }
                $allListsUser = mysqli_query($conn, $queryUsersLists);


                while ($list = mysqli_fetch_assoc($allListsUser)) {
                    $allGamesInListSQL = "SELECT `listGames`.`id`,`listGames`.`listID`,`listGames`.`gameID`,`listGames`.`date`,`games`.`name` as `name` ,`games`.`picture` as `picture` FROM `listGames` INNER JOIN  `games` ON `games`.`gameID` = `listGames`.`gameID` WHERE listID = {$list['id']};";
                    $allGamesInList = mysqli_query($conn, $allGamesInListSQL);
                    echo "<details ";
                    if ($list['visibility'] == 1) {
                        echo " open ";
                    }
                    
                    echo  " id=\"{$list['id']}\" class=\"list\"><summary class=\"list-name\">{$list['nev']} ";
                    
                    
                                    if ($list['visibility'] == 0) {
                                        echo "<i class=\"fa fa-lock\"></i>";
                                    }
                    
                    echo "</summary> <div class=\"wrapper container card-content\">";
                    while ($games = mysqli_fetch_array($allGamesInList)) {
                        echo "<div class=\"card\" >
                                <div class=\"card-header\">
                                    <a href=\"game.php?gameid={$games['gameID']}\" class=\"IdProperty\" title=\"{$games['name']}\"></a>
                                    <h3 class=\"card-name\">{$games['name']}</h3>
                                </div>
                                <div class=\"card-body\">
                                    <img loading=\"lazy\" src=\"" . $games['picture'] . "\">
                                </div>
                            </div>";
                    }
                    echo "</div></details>";
                }

                ?>
                <script src="js/vanilla.kinetic.js"></script>
                <script>
                    let opener = document.getElementById('lists-opener');
                    let i = 2;
                    let detailses = document.querySelectorAll('details');
                    opener.addEventListener('click', () => {
                        if (i % 2 == 0) {
                            for (let j = 0; j < detailses.length; j++) {
                                detailses[j].removeAttribute('open');
                            }
                        } else {
                            for (let j = 0; j < detailses.length; j++) {
                                detailses[j].setAttribute('open', true);
                            }
                        }
                        i++;
                    });

                    const mediaQuery = window.matchMedia('(min-width: 800px)')
                    if (mediaQuery.matches) {
                        var $id = function(id) {
                            return document.getElementById(id);
                        };
                        let element = document.getElementsByClassName("wrapper");
                        
                        var $click = function(elem, fn) {
                            return elem.addEventListener('click', function(e) {
                                fn.apply(elem, [e]);
                            }, false);
                        };
                            for (let i = 0; i < element.length; i++) {
                                new VanillaKinetic(element[i]);
                                
                            }
                        
                    }
                        
                    
                </script>
            </div>
            
        </section>

        <?php require("depend/comments.php"); ?>
    <?php } else { ?>
        <p>This user doesnt exist</p>
        <img src="https://4.bp.blogspot.com/-wN2L8tBHiwQ/VleOOymW-nI/AAAAAAAARn0/NP9A1H9yuS8/s1600/shiny-smile.jpg" alt="">

    <?php } ?>

    <?php require("depend/footer.php"); ?>
    
</body>

</html>