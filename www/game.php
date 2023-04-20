<?php
$id = (int)$_GET['gameid'];
// $gameid = $_GET['gameid'];


require("depend/connection.php");
require("depend/curl.php");


$url = "https://api.igdb.com/v4/covers";
$dataQuery = 'f game.id, game.name,url,game.first_release_date,game.summary,game.platforms.slug,game.platforms.name,game.genres.name,game.involved_companies.company.name,game.videos.video_id,game.game_modes.name, game.screenshots.url,game.websites.url; where id =' . $id . '; l 1;';
$CurledData = getData($url, $dataQuery);
// A játékok lekérdezéséhez el kell érni az IGDB apiját amit a curl.php-ban írtunk meg. Az url változó itt a covers táblában keres és a dataQuery váltázóban adjuk meg a lekérdezést.



// storage 
$gameName = "";
$gamePic = "";
/*
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}*/

//echo $response;
$game_data = json_decode($CurledData);
// a game_data változóban json-é alakítjuk az adatokat


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/game.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Game2Racker</title>
</head>

<body>
    <?php include("depend/navbar.php") ?>
    <div class="game-container">
        <?php
        // Egy foreach ciklusban végig megyünk az adatokon és kíírunk minden számunkra szükséges információt a játékhoz
        foreach ($game_data as $game) {
            $gameName = $game->game->name;
            echo "<div class = \"flex\">

                <div class = \"flex2\">
                
                    <div class = \"mediaflex\">
                        <h1>" . $gameName . "</h1>";
                        $timestamp = $game->game->first_release_date;
                        if ($timestamp == "") {
                            echo "";
                        }
                        else {
                            echo "<p style = \"font-weight: bold;\">Release Date</p>";
                            echo gmdate("Y.m.d", $timestamp);
                        }
                        echo "<p style = \"font-weight: bold;\">Game mode(s)</p>";
                        foreach ($game->game->game_modes as $modes) {
                            echo "<p>" . $modes->name . "</p>";
                        }
                        echo "<p style = \"font-weight: bold;\">Genres</p>";
                        foreach ($game->game->genres as $genre) {
                            echo "<p>" . $genre->name . "</p>";
                        }
                        echo "<p style = \"font-weight: bold;\">Developer(s) & Publisher(s)</p>";
                        foreach ($game->game->involved_companies as $company) {
                            echo "<p>" . $company->company->name . "</p>";
                        }

                        echo "<p style = \"font-weight: bold;\">Platforms</p>";
                        foreach ($game->game->platforms as $platform) {
                            echo "<p>" . $platform->name . "</p>";
                        }

                            echo "<div class = \"webflex\">";
                            
                            foreach ($game->game->websites as $web) {
                                if (preg_match('/steam/', $web->url)) {
                                    echo "<div class = \"steam\">
                                        <a href=\"$web->url  \" target=\"_blank\"></a>
                                    </div>";  
                                }
                                if (preg_match('/epicgames.com\/store/', $web->url)) {
                                    echo "<div class = \"epic\">
                                        <a href=\"$web->url \" target=\"_blank\"></a>
                                    </div>";
                                }
                            }     
                        echo "</div>
                    </div>
                </div>";

            
                echo "<div class = \"flexkep\">";
                            
                    echo "<img src=\"https://" . str_replace("t_thumb", "t_1080p", $game->url) . "\">";
                    
                    $gamePic = "https://" . str_replace("t_thumb", "t_1080p", $game->url);

                    require("depend/rating.php");
                    echo "<div class = \"buttonflex\">";     
                        echo "<button type=\"submit\" class = \"buttonsize\" id = \"stillplaying\"  title = \"Playing\"></button>";

                        echo  "<button type=\"submit\" class = \"buttonsize\" id = \"completed\"  title = \"Completed\"></button>";

                    $isGameInUsersLists = "SELECT `lists`.`id` FROM `lists` INNER JOIN `listGames` on `listGames`.`listID` = `lists`.`id` WHERE `lists`.`userID` = ? AND `listGames`.`gameID` = ?;";
                    $stmt = $conn->prepare($isGameInUsersLists);
                    $stmt->bind_param('ss',$userData['userID'],$id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $stmt->reset();
                    if($result->num_rows > 0){
                        echo "<button type=\"submit\" class = \"buttonsize addtolistcolor\" id = \"addtolist\" title = \"Add to a list\"></button>";
                    }
                    else {
                        echo "<button type=\"submit\" class = \"buttonsize\" id = \"addtolist\" title = \"Add to a list\"></button>";
                    }
                        echo "<button type=\"submit\" class = \"buttonsize\" id = \"wishlist\"  title = \"Wishlist\"></button>
                        <button type=\"submit\" class = \"buttonsize\" id = \"favorite\"  title = \"Favorite\"></button>  
                        </div>
                    </div>
                    
            </div>
            
            <div class = \"summary\">
                <p>" . $game->game->summary . "</p>
            </div>
            <div id = \"screenshots\">";


            $yt_video_id = $game->game->videos[0]->video_id;
            if ($yt_video_id == "") {
                echo "<iframe src=\"https://www.youtube.com/embed/$yt_video_id\" class=\"nincs\"title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>";
            } else {
                echo "<iframe src=\"https://www.youtube.com/embed/$yt_video_id\"title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>";
            }
                
                foreach ($game->game->screenshots as $screen) {
                    if (preg_match('/https/', $screen->url)) {
                        echo "<img title=\"Double click to zoom\" src=\"" . str_replace("t_thumb", "t_1080p", $screen->url) . "\">";
                    }
                    else {
                        echo "<img title=\"Double click to zoom\" src=\"https:" . str_replace("t_thumb", "t_1080p", $screen->url) . "\">";
                    }
                }
                
            
            
            echo "</div>";
            
        }
        ?>
    </div>
    <div id="modal" class="hidden">

        <img src="" alt="">
        <button>×</button>

    </div>


    <?php require("depend/comments.php");?>
    
    

    <?php require("depend/lists.php"); ?>

    <script src="js/vanilla.kinetic.js"></script>
    <script type="text/javascript" charset="utf-8">
    const mediaQuery = window.matchMedia('(min-width: 800px)')
        if (mediaQuery.matches) {
            var $id = function(id) {
            return document.getElementById(id);
        };

        let element = document.getElementById("screenshots");
        var $click = function(elem, fn) {
            return elem.addEventListener('click', function(e) {
                fn.apply(elem, [e]);
            }, false);
        };

        new VanillaKinetic(element);
        }

        

        // new VanillaKinetic(document.getElementById('wrapper'), {
        //     filterTarget: function(target, e) {
        //         if (!/down|start/.test(e.type)) {
        //             return !(/area|a|input/i.test(target.tagName));
        //         }
        //     }
        // });
    </script>
    <script defer>
        let buton = document.getElementById('addtolist');
        buton.addEventListener('click',()=>{

            // let dataForPHP = new FormData();
            // fetch(`depend/pushLists.php`, {
            //     method: "POST",
            //     body: dataForPHP
            // })
            // .then(response => response.text())
            // .then(data => {
            //     console.log(data);
            // })
            // .catch(error => console.log(error));
            // console.log("gaga");
        });
        
    
    </script>
    <script src="js/modal.js" defer></script>
    <script src="js/imgswap.js"></script>
    <?php require("depend/footer.php"); ?>
</body>

</html>