<!-- navbárfüggő file!!-->
<?php
if (isset($_GET['gameid']) || isset($_GET['userid'])) {
    $pageData = array("type" => "", "id" => "");
    if (isset($_GET['gameid'])) {
        $pageData['type'] = "game";
        $pageData['id'] = $id;
    }
    else if (isset($_GET['userid'])) {
        $pageData['type'] = "user";
        $pageData['id'] = $userid;
    }
    // eldönti hogy user vagy game oldalon van a felhasználó és eltárolja az alábbi lekérdezésekhez szükséges adatokat egy tömbben.

    $avgratingSQL = "SELECT ROUND(AVG(rating),2) as avgrating FROM `ratingTable` WHERE ratedThing = '{$pageData['id']}' AND type = '{$pageData['type']}';";
    $avgRatingRes = mysqli_query($conn, $avgratingSQL);
    $avgRatingRow = mysqli_fetch_array($avgRatingRes);
    if ($avgRatingRow['avgrating'] != NULL) {
        $avgRating = $avgRatingRow['avgrating'];
    } else {
        $avgRating = "0";
    }
    // lekéri az adott játék vagy user értékeléseit és átlagolja és egy változóba rakja, ha nincs még neki akkor 0-t ad vissza.

    $yourRatingSQL = "SELECT * FROM `ratingTable` WHERE  ratedThing = {$pageData['id']} AND ratedBy = {$userData['userID']} AND type = '{$pageData['type']}'";
    $yourRatingRes = mysqli_query($conn, $yourRatingSQL);
    if (mysqli_num_rows($yourRatingRes) > 0) {
        $yourRatingRow = mysqli_fetch_array($yourRatingRes);
        $yourRating = $yourRatingRow['rating'];
    } else {
        $yourRating = "";
    }
    // lekérdezi a saját értékelésedet, ha van, ha nincs akkor üres stringet ad.
} 


echo "<div class = \"rating\">";
echo "<h3 class=\"rating\">Score: {$avgRating} </h3>";


$ratingDiv = "";
if (!empty($userData) && ($pageData['type'] == "user" && $userData['userID'] != $pageData['id']) || $pageData['type'] == "game") {
    $ratingDiv = "<input type=\"text\" hidden name=\"rating\" id=\"rating\">
    <ul class=\"newRating\" onMouseOut=\"resetRating();\">
        <li class=\"star\" onmouseover=\"highlightStar(this);\" onmouseout=\"removeHighlight();\" onClick=\"addRating(this);\">&#9733;</li>
        <li class=\"star\" onmouseover=\"highlightStar(this);\" onmouseout=\"removeHighlight();\" onClick=\"addRating(this);\">&#9733;</li>
        <li class=\"star\" onmouseover=\"highlightStar(this);\" onmouseout=\"removeHighlight();\" onClick=\"addRating(this);\">&#9733;</li>
        <li class=\"star\" onmouseover=\"highlightStar(this);\" onmouseout=\"removeHighlight();\" onClick=\"addRating(this);\">&#9733;</li>
        <li class=\"star\" onmouseover=\"highlightStar(this);\" onmouseout=\"removeHighlight();\" onClick=\"addRating(this);\">&#9733;</li>
        <li class=\"star\" onmouseover=\"highlightStar(this);\" onmouseout=\"removeHighlight();\" onClick=\"addRating(this);\">&#9733;</li>
        <li class=\"star\" onmouseover=\"highlightStar(this);\" onmouseout=\"removeHighlight();\" onClick=\"addRating(this);\">&#9733;</li>
        <li class=\"star\" onmouseover=\"highlightStar(this);\" onmouseout=\"removeHighlight();\" onClick=\"addRating(this);\">&#9733;</li>
        <li class=\"star\" onmouseover=\"highlightStar(this);\" onmouseout=\"removeHighlight();\" onClick=\"addRating(this);\">&#9733;</li>
        <li class=\"star\" onmouseover=\"highlightStar(this);\" onmouseout=\"removeHighlight();\" onClick=\"addRating(this);\">&#9733;</li>
    </ul>

    <script>
        let stars = document.querySelectorAll(\".star\");
        let rating = document.getElementById(\"rating\");
        rating.value = \"{$yourRating}\";
        resetRating();

        function highlightStar(obj) {
            removeHighlight();
            for (let i = 0; i < stars.length; i++) {
                stars[i].classList.add(\"highlight\");
                if (stars[i] == obj) {
                    break;
                }
            }
        }

        function removeHighlight() {
            stars.forEach(star => {
                star.classList.remove(\"selected\");
                star.classList.remove(\"highlight\");
            });
        }

        function addRating(obj) {
            for (let i = 0; i < stars.length; i++) {
                stars[i].classList.add(\"selected\");
                rating.value = i + 1;
                if (stars[i] == obj) {
                    
                    break;
                }
            }
            let dataForPHP = new FormData();
            dataForPHP.append(\"ratedThing\", {$pageData['id']});
            dataForPHP.append(\"rating\", rating.value);
            dataForPHP.append(\"type\", \"{$pageData['type']}\");
            fetch(`depend/pushRating.php`, {
                method: \"POST\",
                body: dataForPHP
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
            })
            .catch(error => console.log(error));
            console.log(\"gag\");
        }

        function resetRating() {
            if (rating.value != \"\") {
                for (let i = 0; i < stars.length; i++) {
                    stars[i].classList.add(\"selected\");
                    if ((i + 1) == rating.value) {
                        break;
                    }
                }
            }
        }
    </script>";
}
else if(empty($userData)){
    $ratingDiv = "<input type=\"text\" hidden name=\"rating\" id=\"rating\">
    <ul class=\"newRating\" title = \"If you want to rate, Register!\">
        <li class=\"star\"\" \">&#9733;</li>
        <li class=\"star\" \" \">&#9733;</li>
        <li class=\"star\" \" \">&#9733;</li>
        <li class=\"star\" \"\">&#9733;</li>
        <li class=\"star\" \" \">&#9733;</li>
        <li class=\"star\" \" \">&#9733;</li>
        <li class=\"star\" \" \">&#9733;</li>
        <li class=\"star\" \" \">&#9733;</li>
        <li class=\"star\" \" \">&#9733;</li>
        <li class=\"star\" \" \">&#9733;</li>
    </ul>";
}


// Megnézni hogy létezik token cookie és hogy a cookie tulajdonosa nem egyenlő a jelen oldal userID-jével (tehát a felhasználó nem saját profilján van) vagy egy játék 
//akkor be rakja az oldalra a csillagokat és a kezelésükhöz szükséges scriptet.
// ha teljesül az a feltétel hogy nem létezik a token (a felhasználó vendégként tekinti az oldalt, nincs belépve) akkor üresen kerülnek oda a csillagok.
// egyébként nem kerül oda semmi


echo $ratingDiv;
echo "</div>";

?>