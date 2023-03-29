<!-- always call after navbar -->
<?php


if (isset($_GET['gameid']) || isset($_GET['userid'])) {
    if (isset($_GET['gameid'])) {
        $whereAmI = "game";
        $wholeGrainId = $id;
    }
    else if (isset($_GET['userid'])) {
        $whereAmI = "user";
        $wholeGrainId = $userid;
    }
    
    $RatingSQL = "SELECT ROUND(AVG(rating),2) as realrating FROM `ratingTable` WHERE ratedThing = {$wholeGrainId} AND type = '{$whereAmI}';";

    $queriedRating = mysqli_query($conn, $RatingSQL);

    $ratingrow = mysqli_fetch_array($queriedRating);
    if ($ratingrow['realrating'] != NULL) {
        $rating = $ratingrow['realrating'];
    } else {
        $rating = "0";
    }


    $usersRatingSQL = "SELECT * FROM `ratingTable` WHERE  ratedThing = {$wholeGrainId} AND ratedBy = {$userData['userID']} AND type = '{$whereAmI}'";
    $queriedUsersRating = mysqli_query($conn, $usersRatingSQL);
    if (mysqli_num_rows($queriedUsersRating) > 0) {
        $ratingrow2 = mysqli_fetch_array($queriedUsersRating);
        $selfrating = $ratingrow2['rating'];
    } else {
        $selfrating = "";
    }
} 
function qhar($userid, $userData)
{
    if (isset($_GET['userid'])) {
        if ($userid == $userData) {
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}


echo "<div class = \"rating\">";
echo "<h3 class=\"rating\">Score: {$rating} </h3>";


$ratingDiv = "";
if (isThereValidToken($result)) {
    if (qhar($userid, $userData['userID'])) {
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
            rating.value = \"{$selfrating}\";
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
                dataForPHP.append(\"ratedThing\", {$wholeGrainId});
                dataForPHP.append(\"ratedBy\", {$userData['userID']});
                dataForPHP.append(\"rating\", rating.value);
                dataForPHP.append(\"type\", \"{$whereAmI}\");
                fetch(`dependencies/pushRating.php`, {
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
}
else {
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



echo $ratingDiv;
echo "</div>";

?>