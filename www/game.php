<?php
$id = (int)$_GET['gameid'];
// $gameid = $_GET['gameid'];


require("depend/connection.php");
require("depend/curl.php");

$url = "https://api.igdb.com/v4/covers";
$dataQuery = 'f game.id, game.name,url,game.first_release_date,game.summary,game.platforms.slug,game.platforms.name,game.genres.name,game.involved_companies.company.name,game.videos.video_id,game.game_modes.name, game.screenshots.url,game.websites.url; where id =' . $id . '; l 1;';


$CurledData = getData($url, $dataQuery);



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
    <?php include("depend/navbar.php") ?>
    <div class="game-container">
        <?php
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
                                    echo "<div class = \"steam\">";
                                        echo "<a href=\"$web->url  \" target=\"_blank\"></a>";
                                    echo "</div>";  
                                }
                                if (preg_match('/epicgames.com\/store/', $web->url)) {
                                    echo "<div class = \"epic\">";
                                        echo "<a href=\"$web->url \" target=\"_blank\"></a>";
                                    echo "</div>";
                                }
                            }
                      
                        echo "</div>
                    </div>
                </div>";

            
                echo "<div class = \"flexkep\">";
                            
                    echo "<img src=\"https://" . str_replace("t_thumb", "t_1080p", $game->url) . "\">";
                    
                    $gamePic = "https://" . str_replace("t_thumb", "t_1080p", $game->url);

                    require("depend/rating.php");
                   
                    echo "<div class = \"buttonflex\">
                        <button type=\"submit\" class = \"buttonsize\" id = \"stillplaying\" class = \"stillplayingcolor\" title = \"Playing\"></button>
                        <button type=\"submit\" class = \"buttonsize\" id = \"completed\" class = \"completedcolor\" title = \"Completed\"></button>
                        <button type=\"submit\" class = \"buttonsize\" id = \"addtolist\" class = \"addtolistcolor\" title = \"Add to a list\"></button>
                        <button type=\"submit\" class = \"buttonsize\" id = \"wishlist\" class = \"wishlistcolor\" title = \"Wishlist\"></button>
                        <button type=\"submit\" class = \"buttonsize\" id = \"favorite\" class = \"favoritecolor\" title = \"Favorite\"></button>  
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
    
    

    <div id="lists-menu" class="littleGap flexcol hidden">
        <input id="close-lists" type="button" value="X">
        <h1>Save to...</h1>
        <div class="list-item-container littleGap flexcol">
        <?php 
        
        $queryUsersLists = "SELECT * FROM `lists` WHERE `userID` = {$userData['userID']}";
        $allListsUser = mysqli_query($conn,$queryUsersLists);
        
        
        
        while($row = mysqli_fetch_assoc($allListsUser)) {
            if ($row['type'] == "custom") {
                $GameExistsSQL = "SELECT * FROM `listGames` WHERE gameID = '{$id}' and listID = '{$row['id']}';";
                if (mysqli_num_rows(mysqli_query($conn, $GameExistsSQL)) > 0) {
                    
                    echo "<div id=\"{$row['id']}\" class=\"list-item list-item-active\"><h2>{$row['nev']}</h2></div>";
                }
                else {
                    echo "<div id=\"{$row['id']}\" class=\"list-item\"><h2>{$row['nev']}</h2></div>";
                }
            }
        }
        
        ?>
        </div>
        <div id="create-opener-parent">
            <input id="create-opener" type="button" value="Create new list">
            
        </div>

        <script defer>
            
            let createOpener = document.getElementById('create-opener');
            let createOpenerParent = document.getElementById('create-opener-parent');
            createOpener.addEventListener('click',()=>{
                createOpenerParent.innerHTML += `<div class="list-options">
                <input type="text" name="name" id="list-name">
                <select id="list-visibility" name="visibility" id="list-visibility">
                    <option value="1">Public</option>
                    <option value="0">Private</option>
                </select>
                <input id="create-list" type="button" value="Create">
                </div>`;

                let listName = document.getElementById('list-name');
                let listVisibility = document.getElementById('list-visibility');
                let createListBtn = document.getElementById('create-list');
                createListBtn.addEventListener('click', () => {
                    console.log("gag");
                    let dataForPHP = new FormData();
                    dataForPHP.append("name", listName.value);
                    dataForPHP.append("vis", listVisibility.value);
                    dataForPHP.append("type", "create");
                    fetch(`depend/pushLists.php`, {
                        method: "POST",
                        body: dataForPHP
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        console.log("Bob");
                    })
                    .catch(error => console.log(error));
                    console.log("gag");
    
                });
            });

            let listItems = document.querySelectorAll(".list-item");
            for (let i = 0; i < listItems.length; i++) {
                listItems[i].addEventListener('click',() => {
                    listItems[i].classList.add("list-item-active");

                    let listName = document.getElementById('list-name');
                    let listVisibility = document.getElementById('list-visibility');
                    let createListBtn = document.getElementById('create-list');
                        let dataForPHP = new FormData();
                        dataForPHP.append("gameID", <?php echo $id; ?>);
                        dataForPHP.append("listID", listItems[i].id);
                        dataForPHP.append("gameName", "<?php echo $gameName?>");
                        dataForPHP.append("gamePic", "<?php echo $gamePic?>");
                        dataForPHP.append("type", "add");
                        fetch(`depend/pushLists.php`, {
                            method: "POST",
                            body: dataForPHP
                        })
                        .then(response => response.text())
                        .then(data => {
                            console.log(data);
                            console.log("Bob");
                        })
                        .catch(error => console.log(error));
                        console.log("gag");
                })
                
            }

        </script>
    </div>

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