
<?php

require("depend/curl.php");
require("depend/connection.php");

$searchWord = $_GET["search"];
$searchType = $_GET["type"];



// where game.follows > 4

$searchQuery = '';
$searchQueryUser = '';

switch ($searchType) {
    case 'games':
        $searchQuery = 'fields *,game.*,game.cover.*;where game.category = 0 & game.cover.url ~ *"//images.igdb.com"*; search "'.$searchWord.'"; limit 50;';
        break;
    case 'mod':
        $searchQuery = 'fields *,game.*,game.cover.*; where game.category = 5 & game.cover.url ~ *"//images.igdb.com"* ; search "'.$searchWord.'"; limit 50;';
        break;
    case 'dlc':
        $searchQuery = 'fields *,game.*,game.cover.*; where game.category = 1 | game.category = 2 | game.category = 7 | game.category = 3 & game.cover.url ~ *"//images.igdb.com"* ; search "'.$searchWord.'"; limit 50;';
        break;
    case 'users':
        $searchQueryUser = "SELECT * FROM `users` WHERE nev LIKE '%{$searchWord}%';";
        break;
    default:
        $searchQuery = 'fields *,game.*,game.cover.*; where game.cover.url ~ *"//images.igdb.com"*; search "'.$searchWord.'"; limit 50;';
        $searchQueryUser = "SELECT * FROM `users` WHERE nev LIKE '%{$searchWord}%';";
    break;
        
        
}


if ($searchQuery != "") {
    $searchUrl = "https://api.igdb.com/v4/search";
    $CurledSearch = getData($searchUrl, $searchQuery);
    
    $search_results = json_decode($CurledSearch);    
}

if ($searchQueryUser != "") {
    $search_results_user = mysqli_query($conn,$searchQueryUser);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Game2Racker</title>
</head>

<body>
    <?php include("depend/navbar.php"); ?>

    <div class="searchResults">
        <h2>Result(s) for: <?php echo $searchWord ?></h2>
        <div id="wrapper" class="container card-content">
            <?php

            if ($searchQuery != "") {
                foreach ($search_results as $result) {
                    $gameid = $result->game->cover->id;
                    echo "<div class=\"card\" id = \"$gameid\">";
                    echo    "<a href=\"game.php?gameid=".$result->game->cover->id."\"class=\"IdProperty\"></a>";
                    echo   
                            "<div class=\"card-body\"> ";
                    echo        "<img loading=\"lazy\" src=\"https://" . str_replace("t_thumb", "t_cover_big", $result->game->cover->url) . "\">";
                    echo            "<h3 class = \"display\">" . $result->name . "</h3>";
                    echo    "</div>";

                    echo    "<div class=\"card-header\">";  
                    echo        "<h3>" . $result->name . "</h3>";
                    echo    "</div>";
                    echo "<div class = \"listbtnsearch\">";
                    echo "<button type=\"submit\" class = \"buttonsize\" class = \"addtolistcolor\" title = \"Add to a list\"></button>";
                    echo   "</div>";
                     echo   "</div>";
                    
                     
                }
            }
            ?>

        </div>
        <div class="container card-content">
            <?php
            
                if ($searchQueryUser != "") {
                    while ($userRows = mysqli_fetch_assoc($search_results_user)) {
                        $searchAvatar = $userRows['avatar'] == "" ? "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" : $userRows['avatar'];
                        echo "<div class=\"card\">";
                        echo    "<a href=\"profile.php?user=".$userRows['nev']."&userid=".$userRows['id']."\"class=\"IdProperty\"></a>";
                        echo   
                                "<div class=\"card-body\"> ";
                        echo        "<img loading=\"lazy\" src=\"".$searchAvatar."\">";
                        echo       "<h3 class = \"display\">" . $userRows['nev']. "</h3>";
                        echo    "</div>

                            <div class=\"card-header\">";
                        echo        "<h3 class>" . $userRows['nev']. "</h3>";
                        echo    "</div>
                            </div>";
                    }
                }
            
            ?>
        </div>
    </div>
    
    <!-- lists -->
    
    <?php require("depend/lists.php");?>


    
    <script src="js/modalsearch.js" defer></script>   
</body>

</html>