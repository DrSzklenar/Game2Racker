<?php
$bytes1 = random_bytes(12);
$bytes2 = random_bytes(12);
$bytes3 = random_bytes(12);
$sendComment = "name".bin2hex($bytes1);
$commentInput = "name".bin2hex($bytes2);
$functName = "name".bin2hex($bytes3);

$commentField = "<div class=\"commentSection\">
<div class=\"innerComments flexcol\">
    <h1>Comments</h1>
    <div class=\"writeComment flexcol\">
        <h2>Write a comment...</h2>
        <textarea name=\"\" id=\"{$commentInput}\" cols=\"30\" rows=\"10\"></textarea>
        <input type=\"button\" value=\"Comment\" id=\"{$sendComment}\">
    </div>
    <div class=\"commentContainer littleGap\">";


if (isset($_GET['gameid'])) {
    $whereAmI = "game";
    $wholeGrainId = $id;
} else if (isset($_GET['userid'])) {
    $wholeGrainId = $userid;
    $whereAmI = "user";
    $commentsSQL = "SELECT comment.id ,comment.parentID,comment.madeBy,comment.madeOn,comment.type,comment.date,comment.text,comment.ratio, user.id, user.nev, user.avatar FROM `comment` LEFT JOIN `user` ON comment.madeBy = user.id WHERE comment.type = '{$whereAmI}' AND comment.madeOn = '{$wholeGrainId}'";
    $queriedComments = mysqli_query($conn, $commentsSQL);
    while ($commentRow = mysqli_fetch_array($queriedComments)) {
        $commentField .= "<div class=\"comment flexrow littleGap\">
            <div class=\"leftside\">
                <div class=\"rating flexrow littleGap\">
                    <div class=\"ratingValue\">{$commentRow['ratio']}</div>
                    <div class=\"ratingButtons flexcol\">
                        <div id=\"upbutton\">UP</div>
                        <div id=\"downbutton\">Down</div>
                    </div>
                </div>
            </div>
            <div class=\"rightside flexcol\">
                <div class=\"nameAndDate flexrow littleGap\">
                    <h2>{$commentRow['nev']}</h2>
                    <h2>{$commentRow['date']}</h2>
                </div>
                <div class=\"content\">
                    <p>{$commentRow['text']}</p>
                </div>
            </div>
        </div>";
    } 


}


$commentField .= "</div>

</div>
</div>
<script>
let {$sendComment} = document.getElementById(\"{$sendComment}\");
let {$commentInput} = document.getElementById(\"{$commentInput}\");

{$sendComment}.addEventListener('click',function $functName(){
    if ({$commentInput}.value != \"\") {
        {$sendComment}.removeEventListener('click',$functName);
        
        let dataForPHP = new FormData();
        dataForPHP.append(\"madeOn\", {$wholeGrainId});
        dataForPHP.append(\"text\", {$commentInput}.value);
        dataForPHP.append(\"type\", \"{$whereAmI}\");
        fetch(`dependencies/pushComment.php`, {
            method: \"POST\",
            body: dataForPHP
        })
        .then(response => response.text())
        .then(data => {
            if (data == \"NOPLIZ\") {
                {$sendComment}.addEventListener('click',$functName);
            }
        })
        .catch(error => console.log(error));
        console.log(\"gag\");
        
        {$commentInput}.value = \"\";

        
    }
    });
        
</script>";


echo $commentField;


?>
<!-- <script>

    
        sendComment.addEventListener('click',function MakeTheFetch(){
        if (commentInput.value != "") {
            sendComment.removeEventListener('click',MakeTheFetch);
            let dataForPHP = new FormData();
            dataForPHP.append("madeOn", {$wholeGrainId});
            dataForPHP.append("madeBy", {$userData['userID']});
            dataForPHP.append("text", commentInput.value);
            dataForPHP.append("type", "{$whereAmI}");
            fetch(`dependencies/pushComment.php`, {
                method: "POST",
                body: dataForPHP
            })
            .then(response => response.text())
            .then(data => {
                if (data == "NOPLIZ") {
                    sendComment.addEventListener('click',MakeTheFetch());
                }
            })
            .catch(error => console.log(error));
            console.log("gag");
            
            commentInput.value = "";
            
        }
        });
    
</script> -->
            
<!-- <script>
let {$sendComment} = document.getElementById("{$sendComment}");
let {$commentInput} = document.getElementById("{$commentInput}");

function MakeComment(){
    {$sendComment}.addEventListener('click',function $functName(){
    if ({$commentInput}.value != "") {
        {$sendComment}.removeEventListener('click',$functName);
        
        let dataForPHP = new FormData();
        dataForPHP.append("madeOn", {$wholeGrainId});
        dataForPHP.append("text", {$commentInput}.value);
        dataForPHP.append("type", "{$whereAmI}");
        fetch(`dependencies/pushComment.php`, {
            method: "POST",
            body: dataForPHP
        })
        .then(response => response.text())
        .then(data => {
            if (data == "NOPLIZ") {
                {$sendComment}.addEventListener('click',$functName);
            }
        })
        .catch(error => console.log(error));
        console.log("gag");
        
        {$commentInput}.value = "";

        
    }
    });
    break;
}
</script>"; -->

        
<!-- <div class="commentSection">
    <div class="innerComments flexcol">
        <h1>Comments</h1>
        <div class="writeComment flexcol">
            <h2>Write a comment...</h2>
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="commentContainer flexcol littleGap">
            <div class="comment flexrow littleGap">
                <div class="leftside">
                    <div class="rating flexrow littleGap">
                        <div class="ratingValue">10</div>
                        <div class="ratingButtons flexcol">
                            <div id="upbutton">UP</div>
                            <div id="downbutton">Down</div>
                        </div>
                    </div>
                </div>
                <div class="rightside flexcol">
                    <div class="nameAndDate flexrow littleGap">
                        <h2>Kaklanaf</h2>
                        <h1>2023 03 23</h1>
                    </div>
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, perspiciatis minus nisi enim, saepe natus voluptatibus laboriosam illo neque nihil earum doloremque. Reprehenderit unde porro corporis doloremque, voluptatem sunt consequatur?</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div> -->


