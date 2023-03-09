<?php

function getData($url = "",  $postFields = "")
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_HTTPHEADER => array(
            'Client-ID: 1gdsndj0p60xua0ac6a6n7kcldeho8',
            'Authorization: Bearer im5fl0se5llzvdjv4py7eyvbsnaijk',
            'Content-Type: text/plain',
            'Cookie: __cf_bm=i6Ct3Bu80LLr8boRVUD1wxvgulosh8XFKTwuawwkfJQ-1678262079-0-AS34GswIhE0/1Ex1L6yfy/Av/Bcd19Ks+BwZ4W9MqR2TanALgtaOjKY62QlTvCm+BpUKZUqUeQ+J7autpnE0eo4='
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

$trendingQuery = 'f game.id,game.name,url,game.genres.name,game.first_release_date,game.summary,game.platforms.slug; s id asc; where id >= 1 & game.first_release_date > 1641034800 & game.platforms.slug = "win" & game.rating >= 75; l 500;';
$topQuery = 'f game.name,url,game.genres.name,game.first_release_date,game.summary,game.platforms.slug,game.platforms.name, game.total_rating; sort total_rating_count desc;
where game.platforms.slug = "win" & game.total_rating >= 90; l 500;';
$url = "https://api.igdb.com/v4/covers";
$CurledTrending = getData($url, $trendingQuery);
$CurledTop = GetData($url, $topQuery);

$top_games = json_decode($CurledTop);
$trending_games = json_decode($CurledTrending);


/*
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}*/

//echo $response;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/homepage.css">
    <link rel="stylesheet" href="/css/menu.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Game2Racker</title>
</head>

<body>
    <nav>
        <div class="banner">Game2Racker</div>
        <div class="search">
            <div class="rot">
                <div class="selectParent">
                <select name="type" id="type">
                    <option value="all">All</option>
                    <option value="titles">Titles</option>
                    <option value="dlc">Dlc</option>
                    <option value="mod">Mod</option>
                    <option value="users">Users</option>
                </select>
                </div>
                <input type="text" name="search" id="search">
            </div>
        </div>
    </nav>
    <div class="trending">
        <h1>New Releases</h1>
        <div id="wrapper" class="container card-content">

            <?php
            foreach ($trending_games as $game) {
                echo "<div class=\"card\"><div class=\"card-header\"> ";
                echo "<a href=\"game.php?id=" . $game->id . "\"class=\"IdProperty\"><a>";
                echo "<h3>" . $game->game->name . "</h3>";
                echo "</div><div class=\"card-body\"> ";
                echo "<img src=\"" . str_replace("t_thumb", "t_cover_big", $game->url) . "\">";
                echo "</div></div>";
            }
            ?>
        </div>

        <!--Lapozó-->
        <!-- <div class="pagination">
            <li class="page-item previous-page disable"><a class="page-link" href="#">Prev</a></li>
            <li class="page-item current-page active"><a class="page-link" href="#">1</a></li>
            <li class="page-item dots"><a class="page-link" href="#">...</a></li>
            <li class="page-item current-page"><a class="page-link" href="#">5</a></li>
            <li class="page-item current-page"><a class="page-link" href="#">6</a></li>
            <li class="page-item dots"><a class="page-link" href="#">...</a></li>
            <li class="page-item current-page"><a class="page-link" href="#">10</a></li>
            <li class="page-item next-page"><a class="page-link" href="#">Next</a></li>
        </div> -->
    </div>


    <div class="AlltimeTop">
        <h1>All time Top games</h1>
        <div id="wrapper2" class="container card-content">
            <?php
            foreach ($top_games as $game) {
                echo "<div class=\"card\"><div class=\"card-header\"> ";
                echo "<a href=\"game.php?id=" . $game->id . "\"class=\"IdProperty\"><a>";
                echo "<h3>" . $game->game->name . "</h3>";
                echo "</div><div class=\"card-body\"> ";
                echo "<img src=\"" . str_replace("t_thumb", "t_cover_big", $game->url) . "\">";
                echo "</div></div>";
            }
            ?>
        </div>
    </div>
    <!-- <script src="/js/paginator.js"></script> -->
    <!-- <script src="/js/smooth.js"></script> -->
    <script src="js/vanilla.kinetic.js"></script>
    <script type="text/javascript" charset="utf-8">
        var $id = function(id) {
            return document.getElementById(id);
        };
        let element = document.getElementById("wrapper");
        let element2 = document.getElementById("wrapper2");
        var $click = function(elem, fn) {
            return elem.addEventListener('click', function(e) {
                fn.apply(elem, [e]);
            }, false);
        };

        new VanillaKinetic(element);
        new VanillaKinetic(element2);

        new VanillaKinetic(document.getElementById('wrapper'), {
            filterTarget: function(target, e) {
                if (!/down|start/.test(e.type)) {
                    return !(/area|a|input/i.test(target.tagName));
                }
            }
        });
    </script>
    <!-- <script src="/js/dragger.js"></script> -->
</body>

</html>