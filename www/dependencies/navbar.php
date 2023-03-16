<?php

require("connection.php");
require("tokenHandler.php");

$result = mysqli_query($conn, $tokenQuery);

session_start();
$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
/**
 * userData data helyett data
 * $
 */
$userData = getUserData($result);
//$isTokenValid = isThereValidToken($result);

//echo $isTokenValid;




function printBar($userData) {
    
    $bar = "";
    /*
    echo "<pre>";
    print_r($userData);
    echo "</pre>";
    */

    if ($userData) {
       // $userData = mysqli_fetch_array($result);

       $avatar = $userData['avatar'] == "" ? "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" : $userData['avatar'];
        
       $bar = "<div class=\"profile\">
        <h1 id=\"name\">{$userData['nev']}</h1>
        <div class=\"avatar\">
            <img class=\"avatarPic\" src=\"{$avatar}\" alt=\"\">
            <a href=\"profile.php?user=".$userData['nev']."&userid=".$userData['userID']."\"class=\"profileLink\"></a>
        </div>
        <div id=\"menu\">
            <input type=\"button\" value=\"Kilépés\" id=\"signOut\">
            <script>
            let signOut = document.getElementById(\"signOut\");
            signOut.addEventListener('click', () => {
                document.cookie = \"session=''; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/\";
                window.location.reload();
            });

        </script>
        
        </div>
        </div>";    
    } else {
        $bar = "<div class=\"logins\">
        <div class=\"buttonParent\">
        <a id=\"login\" href=\"/login/login.php\">Login</a>
        </div>
        <div class=\"buttonParent\">
        <a  id=\"register\"  href=\"/login/register.php\">Sign Up</a>
        </div>
        </div>";    
    }
    print_r($bar);    
}

?>
<nav>
    <a class="banner" href="/">Game2Racker</a>
    <div class="search">
        <form class="searchForm" action="/search.php" method="get">
            <div class="selectParent">
                <select name="type" id="type" required>
                    <option <?php if ($_GET['type'] == "all") {echo "selected";}  ?> value="all">All</option>
                    <option <?php if ($_GET['type'] == "games") {echo "selected";}  ?> value="games">Games</option>
                    <option <?php if ($_GET['type'] == "dlc") {echo "selected";}  ?> value="dlc">DLC</option>
                    <option <?php if ($_GET['type'] == "mod") {echo "selected";}  ?> value="mod">Mod</option>
                    <option <?php if ($_GET['type'] == "users") {echo "selected";}  ?> value="users">Users</option>
                </select>
            </div>
            <input type="text" name="search" id="searchInput" placeholder="Search games, DLC, mods and users">
            <input id="submit" type="submit" value="" class="searchbtn">

        </form>
    </div>
    <?php
printBar($userData);
?>
    <?php
    
    
    
    ?>
        
    </nav>
    <script src="js/navbar.js" defer></script>