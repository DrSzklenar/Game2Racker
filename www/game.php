<?php
$id = (int)$_GET['id'];
$gameid = $_GET['gameid'];


require("dependencies/connection.php");
require("dependencies/curl.php");

$url = "https://api.igdb.com/v4/covers";
$urlscreen = "https://api.igdb.com/v4/screenshots";
$web = "https://api.igdb.com/v4/websites";
$dataQuery = 'f game.id, game.name,url,game.first_release_date,game.summary,game.platforms.slug,game.platforms.name,game.genres.name,game.involved_companies.company.name,game.videos.video_id; where id =' . $id . '; l 1;';
$screenQuery = 'f url; where game = ' . $gameid . ';';
$steamQuery = 'f url; w game = ' . $gameid . ' & url ~ *"steam"*;';
$epicQuery = 'f url; w game = ' . $gameid . ' & url ~ *"epicgames.com/store"*;';
$CurledData = getData($url, $dataQuery);
$CurledScreen = getData($urlscreen, $screenQuery);
$Curledsteam = getData($web, $steamQuery);
$Curledepic = getdata($web, $epicQuery);


/*
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}*/

//echo $response;
$game_data = json_decode($CurledData);
$screen_data = json_decode($CurledScreen);
$web_data = json_decode($Curledsteam);
$epicweb_data = json_decode($Curledepic);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/gamestyle.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Game2Racker</title>
</head>

<body>
    <?php include("dependencies/navbar.php") ?>
    <div class="container">
        <?php



        foreach ($game_data as $game) {

            echo "<div class = \"flex\">";
            echo "<div class = \"flex2\">";
            echo "<h1>" . $game->game->name . "</h1>";
            echo "<p style = \"font-weight: bold;\">Release Date</p>";
            $timestamp = $game->game->first_release_date;
            echo gmdate("Y.m.d", $timestamp);
            echo "<p style = \"font-weight: bold;\">Genres</p>";
            foreach ($game->game->genres as $genre) {
                echo "<p>" . $genre->name . "</p>";
            }
            echo "<p style = \"font-weight: bold;\">Developers & Publishers</p>";
            foreach ($game->game->involved_companies as $company) {
                echo "<p>" . $company->company->name . "</p>";
            }

            echo "<p style = \"font-weight: bold;\">Platforms</p>";
            foreach ($game->game->platforms as $platform) {
                echo "<p>" . $platform->name . "</p>";
            }

            echo "<div class = \"webflex\">";


            foreach ($web_data as $steam) {
                $steam1 = $steam->url;

                if ($steam1 == "") {
                    echo "<div class = \"epic\">";
                    foreach ($epicweb_data as $epic) {
                        echo "<a href=\"$epic->url \"></a>";
                    }

                    echo "</div>";
                } else {
                    echo "<div class = \"steam\">";
                    foreach ($web_data as $steam) {
                        echo "<a href=\"$steam->url \"></a>";
                    }
                    echo "</div>";
                }
            }

            foreach ($epicweb_data as $epic) {
                $epic1 = $epic->url;

                if ($epic1 == "") {
                    echo "<div class = \"steam\">";
                    foreach ($web_data as $steam) {
                        echo "<a href=\"$steam->url \"></a>";
                    }
                    echo "</div>";
                } else {
                    echo "<div class = \"epic\">";
                    foreach ($epicweb_data as $epic) {
                        echo "<a href=\"$epic->url \"></a>";
                    }

                    echo "</div>";
                }
            }


            echo "</div>";

            echo "</div>";
            echo "<div class = \"flexkep\"";
            echo "<div class = \"kep\">";
            echo "<img src=\"https://" . str_replace("t_thumb", "t_1080p", $game->url) . "\">";



            echo "Rating";
            require("dependencies/rating.php");

            echo "<div class = \"buttonflex\">
            <button type=\"submit\" class = \"buttonsize\" id = \"stillplaying\" class = \"stillplayingcolor\" title = \"Playing\"></button>
            <button type=\"submit\" class = \"buttonsize\" id = \"completed\" class = \"completedcolor\" title = \"Completed\"></button>
            <button type=\"submit\" class = \"buttonsize\" id = \"addtolist\" class = \"addtolistcolor\" title = \"Add to a list\"></button>
            <button type=\"submit\" class = \"buttonsize\" id = \"wishlist\" class = \"wishlistcolor\" title = \"Wishlist\"></button>
            <button type=\"submit\" class = \"buttonsize\" id = \"favorite\" class = \"favoritecolor\" title = \"Favorite\"></button>
           </div>";
            echo "</div>";
            echo "</div>";


            echo "</div>";
            echo "</div>";


            echo "<div class = \"summary\">";
            echo "<p>" . $game->game->summary . "</p>";
            echo "</div>";
            echo "<div id = \"screenshots\">";


            $yt_video_id = $game->game->videos[0]->video_id;
            if ($yt_video_id == "") {
                echo "<iframe src=\"https://www.youtube.com/embed/$yt_video_id\" class=\"nincs\"title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>";
            } else {
                echo "<iframe src=\"https://www.youtube.com/embed/$yt_video_id\"title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>";
            }

            foreach ($screen_data as $screen) {
                echo "<img src=\"https://" . str_replace("t_thumb", "t_1080p", $screen->url) . "\">";
            }
            
            
        }
        ?>
    </div>
    <div id="modal" class="hidden">

        <img src="" alt="">
        <button>×</button>

    </div>

    <?php require("dependencies/comments.php");?>

    <script src="js/vanilla.kinetic.js"></script>
    <script type="text/javascript" charset="utf-8">
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

        // new VanillaKinetic(document.getElementById('wrapper'), {
        //     filterTarget: function(target, e) {
        //         if (!/down|start/.test(e.type)) {
        //             return !(/area|a|input/i.test(target.tagName));
        //         }
        //     }
        // });
    </script>
    <script src="js/modal.js"></script>
    <script src="js/imgswap.js"></script>
    <?php require("dependencies/footer.php"); ?>
</body>

</html>