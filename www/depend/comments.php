<?php
$bytes1 = random_bytes(12);
$bytes2 = random_bytes(12);
$bytes3 = random_bytes(12);
$sendComment = "name".bin2hex($bytes1);
$commentInput = "name".bin2hex($bytes2);
$functName = "name".bin2hex($bytes3);

$commentField = "<div class=\"commentSection\">
<div class=\"innerComments flexcol littleGap\">
    <h1>Comments</h1>
    <div class=\"writeComment flexcol\">
        <h2>Write a comment...</h2>
        <textarea name=\"\" id=\"{$commentInput}\" cols=\"30\" rows=\"10\"></textarea>
        <input type=\"button\" value=\"Comment\" id=\"{$sendComment}\">
    </div>
    <div class=\"commentContainer littleGap\">";


if (isset($_GET['gameid']) || isset($_GET['userid'])) {
    if (isset($_GET['gameid'])) {
        $whereAmI = "game";
        $wholeGrainId = $id;
    }
    else if (isset($_GET['userid'])) {
        $wholeGrainId = $userid;
        $whereAmI = "user";
    }
    $commentsSQL = "SELECT 
    comment.id AS 'comment_id' ,comment.parentID,comment.madeBy,comment.madeOn,comment.type,comment.date,comment.text, user.id AS 'user_id' , user.nev, user.avatar, IFNULL(SUM(ratios.ratio),0) as ratio
    FROM `comment` LEFT JOIN `user` ON comment.madeBy = user.id 
    LEFT JOIN `ratios` ON ratios.commentID = comment.id 
    WHERE comment.type = '{$whereAmI}' AND comment.madeOn = '{$wholeGrainId}' GROUP BY comment.id  ORDER BY comment.date DESC;";
    $queriedComments = mysqli_query($conn, $commentsSQL);
    
    $ratiosSQL = "SELECT * FROM `ratios` WHERE ratios.commentID = '{$wholeGrainId}' AND ratios.userID = '{$wholeGrainId}'";
    $querieRatios = mysqli_query($conn, $ratiosSQL);
    
    while ($commentRow = mysqli_fetch_array($queriedComments)) {
        $commentField .= "<div id=\"{$commentRow['comment_id']}\" class=\"comment flexrow littleGap\">
            <div class=\"leftside\">
                <div class=\"rating flexrow littleGap\">
                    <div class=\"ratingValue\">{$commentRow['ratio']}</div>
                    <div class=\"ratingButtons flexcol\">";
                    
                    // select * ratio from ratios where commentid = $commentRow['commentid'] and userID = 9;
                    // if more than one row color based on ratios value.
                    $RatioSQL = "SELECT * FROM `ratios` WHERE  commentID = {$commentRow['comment_id']} AND userID = {$userData['userID']}";
                    $queriedRatio = mysqli_query($conn, $RatioSQL);
                
                    if (mysqli_num_rows($queriedRatio) > 0) {
                        $ratiorow = mysqli_fetch_array($queriedRatio);
                        if ($ratiorow['ratio'] > 0) {
                            $commentField .= "<div class=\"upbutton\"><i class=\"fa fa-thumbs-up liked\"></i></div>
                            <div class=\"downbutton\"><i class=\"fa fa-thumbs-down\"></i></div>";
                        }
                        else if($ratiorow['ratio'] < 0) {
                            $commentField .= "<div class=\"upbutton\"><i class=\"fa fa-thumbs-up\"></i></div>
                            <div class=\"downbutton\"><i class=\"fa fa-thumbs-down disliked\"></i></div>";
                        }
                        else {
                            $commentField.="
                        <div class=\"upbutton\"><i class=\"fa fa-thumbs-up\"></i></div>
                        <div class=\"downbutton\"><i class=\"fa fa-thumbs-down\"></i></div>";
                        }
                    }
                    else {
                        $commentField.="
                        <div class=\"upbutton\"><i class=\"fa fa-thumbs-up\"></i></div>
                        <div class=\"downbutton\"><i class=\"fa fa-thumbs-down\"></i></div>";
                    }
                    
                    $commentField.="
                    </div>
                </div>
            </div>
            <div class=\"rightside flexcol\">
                <div class=\"nameAndDate flexrow littleGap\">
                    <img class=\"commentAvatar\" src=\"{$commentRow['avatar']}\" alt=\"\">
                    <h2><a href=\"profile.php?user=".$commentRow['nev']."&userid=".$commentRow['user_id']."\"class=\"\">{$commentRow['nev']}</a></h2>
                    <h4>{$commentRow['date']}</h4>
                </div>
                <div class=\"content\">
                    <p>{$commentRow['text']}</p>
                </div>
            </div>";
                    
            if ($userData['userID'] == $wholeGrainId || $commentRow['user_id'] == $userData['userID']) {
                $commentField .= "<div class=\"kuka\"><i class=\"fa fa-trash\"></i></div>";
                
            }
            $commentField .="
        </div>";
    } 
}

$commentField .= "</div>

</div>
</div>
<script type=\"text/javascript\">
let {$sendComment} = document.getElementById(\"{$sendComment}\");
let {$commentInput} = document.getElementById(\"{$commentInput}\");

{$sendComment}.addEventListener('click',function $functName(){
    if ({$commentInput}.value != \"\") {
        {$sendComment}.removeEventListener('click',$functName);
        
        let dataForPHP = new FormData();
        dataForPHP.append(\"madeOn\", {$wholeGrainId});
        dataForPHP.append(\"text\", {$commentInput}.value);
        dataForPHP.append(\"type\", \"{$whereAmI}\");
        fetch(`depend/pushComment.php`, {
            method: \"POST\",
            body: dataForPHP
        })
        .then(response => response.text())
        .then(data => {
            console.log(data)
            if (data == \"NOPLIZ\") {
                {$commentInput}.value = \"\";
                {$sendComment}.addEventListener('click',$functName);
                window.location.reload();
            }
            else if(data == \"GANTZ\"){
                setTimeout({$sendComment}.addEventListener('click',$functName),5000)
            }
        })
        .catch(error => console.log(error));
        console.log(\"gag\");
    }
    });

    let upbuttons = document.querySelectorAll(\".upbutton\");
    let downbuttons = document.querySelectorAll(\".downbutton\");
    function PushVotes(element,stat=\"\"){
        let parentID = element.parentElement.parentElement.parentElement.parentElement.id;
        console.log(parentID);
        console.log(element.firstElementChild);
        let ratio = \"\";
        if (stat == \"plus\") {
            if (element.firstElementChild.classList.contains(\"liked\")) {
                element.parentElement.parentElement.firstChild.nextSibling.innerHTML = parseInt(element.parentElement.parentElement.firstChild.nextSibling.innerHTML) -1;
                element.firstElementChild.classList.remove(\"liked\");
                ratio = 0;
                console.log(\"it was liked.removed!\");
            }
            else if(element.parentElement.lastElementChild.firstElementChild.classList.contains(\"disliked\"))
            {
                element.parentElement.parentElement.firstChild.nextSibling.innerHTML = parseInt(element.parentElement.parentElement.firstChild.nextSibling.innerHTML) +2;
                element.parentElement.lastElementChild.firstElementChild.classList.remove(\"disliked\");
                element.firstElementChild.classList.add(\"liked\");
                ratio = 1;
                console.log(\"it was disliked.removed and liked!\");
            }
            else{
                element.parentElement.parentElement.firstChild.nextSibling.innerHTML = parseInt(element.parentElement.parentElement.firstChild.nextSibling.innerHTML) +1;
                element.firstElementChild.classList.remove(\"disliked\");
                element.firstElementChild.classList.add(\"liked\");
                ratio = 1;
                console.log(\"it was on default. liked!\");
            }
        }
        else if (stat == \"minus\") {
            if (element.firstElementChild.classList.contains(\"disliked\")) {
                element.parentElement.parentElement.firstChild.nextSibling.innerHTML = parseInt(element.parentElement.parentElement.firstChild.nextSibling.innerHTML) +1;
                element.firstElementChild.classList.remove(\"disliked\");
                ratio = 0;
                console.log(\"it was disliked.removed!\");
            }
            else if(element.parentElement.firstElementChild.firstElementChild.classList.contains(\"liked\"))
            {
                element.parentElement.parentElement.firstChild.nextSibling.innerHTML = parseInt(element.parentElement.parentElement.firstChild.nextSibling.innerHTML) -2;
                element.parentElement.firstElementChild.firstElementChild.classList.remove(\"liked\");
                element.firstElementChild.classList.add(\"disliked\");
                ratio = -1;
                console.log(\"it was liked.removed and disliked!\");
            }
            else{
                element.parentElement.parentElement.firstChild.nextSibling.innerHTML = parseInt(element.parentElement.parentElement.firstChild.nextSibling.innerHTML) -1;
                element.firstElementChild.classList.remove(\"liked\");
                element.firstElementChild.classList.add(\"disliked\");
                ratio = -1;
                console.log(\"it was on default. disliked!\");
            }
        }

        let dataForPHP = new FormData();
        dataForPHP.append(\"madeOn\", parentID);
        dataForPHP.append(\"ratio\", ratio);
        dataForPHP.append(\"type\", \"vote\");
        fetch(`depend/pushComment.php`, {
            method: \"POST\",
            body: dataForPHP
        })
        .then(response => response.text())
        .then(data => {
            console.log(data)
            if (data == \"NOPLIZ\") {
            }
            else if(data == \"GANTZ\"){
                console.log(\"gatya van\")
            }
        })
        .catch(error => console.log(error));
        console.log(\"gag\");
        
    }
    for (let i = 0; i < upbuttons.length; i++) {
        upbuttons[i].addEventListener('click',() => PushVotes(upbuttons[i],\"plus\"));
        downbuttons[i].addEventListener('click',() => PushVotes(downbuttons[i],\"minus\"));
    }   

    function DeleteComment(element) {
        let dataForPHP = new FormData();
        dataForPHP.append(\"madeOn\", element.parentElement.id);
        dataForPHP.append(\"type\", \"delete\");
        fetch(`depend/pushComment.php`, {
            method: \"POST\",
            body: dataForPHP
        })
        .then(response => response.text())
        .then(data => {
            console.log(data)
            if (data == \"DELETED\") {
                console.log(element.parentElement.id);
            }
        })
        .catch(error => console.log(error));
        console.log(\"gag\");
    }

    let kukas = document.querySelectorAll(\".kuka\");
    for (let i = 0; i < kukas.length; i++) {
        kukas[i].addEventListener('click',() => DeleteComment(kukas[i]));
    }

        
</script>";
echo $commentField;
?>
