<!-- always call after navbar -->
<?php


if (isset($_GET['gameid'])) {
    $gameRatingSQL = "SELECT ROUND(AVG(rating),2) as realrating FROM `ratingGame` WHERE ratedGame = {$id};";

    $queriedGameRating = mysqli_query($conn, $gameRatingSQL);

    $ratingrow = mysqli_fetch_array($queriedGameRating);
    if ($ratingrow['realrating'] != NULL) {
        $rating = $ratingrow['realrating'];
    } else {
        $rating = "0";
    }


    $usersRatingSQL = "SELECT * FROM `ratingGame` WHERE  ratedGame = {$id} AND ratedBy = {$userData['userID']}";
    $queriedUsersRating = mysqli_query($conn, $usersRatingSQL);
    if (mysqli_num_rows($queriedUsersRating) > 0) {
        $ratingrow2 = mysqli_fetch_array($queriedUsersRating);
        $selfrating = $ratingrow2['rating'];
    } else {
        $selfrating = 5.55;
    }
    $whereAmI = "game";
    $wholeGrainId = $id;
} else if (isset($_GET['userid'])) {

    $userRatingSQL = "SELECT ROUND(AVG(rating),2) as realrating FROM `ratingUser` WHERE ratedUser = {$userid};";


    $queriedUserRating = mysqli_query($conn, $userRatingSQL);




    $ratingrow = mysqli_fetch_array($queriedUserRating);
    if ($ratingrow['realrating'] != NULL) {
        $rating = $ratingrow['realrating'];
    } else {
        $rating = "0";
    }


    $usersRatingSQL = "SELECT * FROM `ratingUser` WHERE  ratedUser = {$userid} AND ratedBy = {$userData['userID']}";
    $queriedUsersRating = mysqli_query($conn, $usersRatingSQL);
    if (mysqli_num_rows($queriedUsersRating) > 0) {
        $ratingrow2 = mysqli_fetch_array($queriedUsersRating);
        $selfrating = $ratingrow2['rating'];
    } else {
        $selfrating = 5.55;
    }
    $wholeGrainId = $userid;
    $whereAmI = "user";
}
function qhar($userid, $userData){
    if (isset($_GET['userid'])) {
        if ($userid == $userData) {
            return false;
        }
        else {
            return true;
        }
    }
    else {
        return true;
    }

}


echo "<div class = \"rating\"";
echo "<h3 class=\"rating\">Score: {$rating} </h3>";


$ratingDiv = "";

if (isThereValidToken($result)) {
    if (qhar($userid,$userData['userID'])) 
    {
        $ratingDiv =  "<div class=\"slidecontainer\">
            <input type=\"range\" min=\"1\" max=\"10\" value=\"$selfrating\" class=\"slider\" id=\"ratingSlider\">
            <input id=\"submitRate\" type=\"button\" value=\"Rate\">
            </div>
        <script>
        let range = document.getElementById(\"ratingSlider\");
        let submitRate = document.getElementById(\"submitRate\");
        
        submitRate.addEventListener('click',() => {
            let dataForPHP = new FormData();
            dataForPHP.append(\"ratedThing\", {$wholeGrainId});
            dataForPHP.append(\"ratedBy\", {$userData['userID']});
            dataForPHP.append(\"rating\", range.value);
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
                
            });
            </script>";
    } 
}

echo $ratingDiv;

?>