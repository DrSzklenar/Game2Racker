<?php

echo date("Y-m-d H:i:s");


?><nav>
    <a class="banner" href="/">Game2Racker</a>
    <div class="search">
        <form class="rot" action="/search.php" method="get">
            <div class="selectParent">
                <select name="type" id="type">
                    <option value="all">All</option>
                    <option value="titles">Games</option>
                    <option value="dlc">DLC</option>
                    <option value="mod">Mod</option>
                    <option value="users">Users</option>
                </select>
            </div>
            <input type="text" name="search" id="search" placeholder="Search games, DLC, mods and users">
            <input id="submit" type="submit" value="search">
        </form>
    </div>
    <?php

    $loginBar = `<div class="logins">
    <div class="buttonParent">
        <a href="/login/login.php">Login</a>
    </div>
    <div class="buttonParent">
        <a href="/login/register.php">Sign Up</a>
    </div>
</div>`;



    ?>
</nav>