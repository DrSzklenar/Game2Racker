<?php

require("connection.php");
require("tokenHandler.php");

$result = mysqli_query($conn, $tokenQuery);

$userData = getUserData($result);
echo $userData;
echo "DIS IS THE USER DATA";


$avatar = $userData['avatar'] == "" ? "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" : $userData['avatar'];






?>
<nav>
    <a class="banner" href="/">Game2Racker</a>
    <div class="search">
        <form class="searchForm" action="/search.php" method="get">
            <div class="selectParent">
                <select name="type" id="type">
                    <option value="all">All</option>
                    <option value="titles">Games</option>
                    <option value="dlc">DLC</option>
                    <option value="mod">Mod</option>
                    <option value="users">Users</option>
                </select>
            </div>
            <input type="text" name="search" id="searchInput" placeholder="Search games, DLC, mods and users">
            <input id="submit" type="submit" value="search">
        </form>
    </div>
    <?php





$loginBar = "<div class=\"logins\">
<div class=\"buttonParent\">
<a href=\"/login/login.php\">Login</a>
</div>
<div class=\"buttonParent\">
<a href=\"/login/register.php\">Sign Up</a>
</div>
</div>";


$profile = "<div class=\"profile\">
<h1 id=\"name\">{$userData['nev']}</h1>
<div class=\"avatar\">
    <img class=\"avatarPic\" src=\"{$avatar}\" alt=\"\">
    <a href=\"profile.php?user=".$userData['nev']."&userid=".$userData['userID']."\"class=\"profileLink\"></a>
</div>
<div id=\"menu\"></div>
</div>";

// <a href=\"profile.php?user=".$userData['nev']."&userid=".$userData['userID']."\"class=\"profileLink\"></a>


if (!$tokenStatus) {
    print_r($loginBar);
} else {
    print_r($profile);
}

?>
    
    
    
    
    <!-- 
        <div class="profile">
            <h1 class="name">{$userData['nev']}</h1>
            <img class="avatar" src="{$avatar}" alt="">
            
        </div> -->
        <!-- <a href=""><img class="avatar" src="{$avatar}" alt=""></a> -->
        
        
    </nav>
    <script src="js/navbarmenu.js" defer></script>