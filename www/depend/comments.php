<?php
$bytes1 = random_bytes(12);
$bytes2 = random_bytes(12);
$bytes3 = random_bytes(12);
$sendComment = "name".bin2hex($bytes1);
$commentInput = "name".bin2hex($bytes2);
$functName = "name".bin2hex($bytes3);

//random generált változónevek a rosszindulatú javascript parancsok kiadásának megnehezítésére (ebben az esetben comment spam)

$commentField = "<section class=\"commentSection\">
<div class=\"innerComments flexcol littleGap\">
    <h1>Comments</h1>
    <form class=\"writeComment flexcol\">
        <textarea name=\"\" id=\"{$commentInput}\" cols=\"30\" rows=\"10\" placeholder=\"Write a comment...\" onkeypress=\"Enter(event)\"></textarea>
        <input type=\"submit\" value=\"Comment\" class=\"comment-send\" id=\"{$sendComment}\">
    </form>
    <div class=\"commentContainer littleGap\">";
//megkezdjük felépíteni a komment szekciót, az egészet egy php változóban tároljuk el stringként (ami jelen esetben html kód lesz) A végén az egészet ki írjuk.

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
    //get metódus alapján értéket adunk a pagedata asszociatív tömbnek
    $commentsSQL = "SELECT 
    comment.id AS 'comment_id' ,comment.madeBy,comment.madeOn,comment.type,comment.date,comment.text, `users`.id AS 'user_id' , `users`.nev, `users`.avatar, IFNULL(SUM(ratios.ratio),0) as ratio
    FROM `comment` LEFT JOIN `users` ON comment.madeBy = `users`.id 
    LEFT JOIN `ratios` ON ratios.commentID = comment.id 
    WHERE comment.type = '{$pageData['type']}' AND comment.madeOn = '{$pageData['id']}' GROUP BY comment.id  ORDER BY comment.date DESC;";
    $queriedComments = mysqli_query($conn, $commentsSQL);
    //lekérdezzük az összes kommentet  a pagedata alapján , és hozzá tartozó ratiokat a commentid idegen kulcs alapján, LEFT JOINT, használunk hogy azok a kommentek is megjelenjenek amikhez nem tartozik ratio.
    //GROUP BY comment.id miatt tudjuk SUM-olni a ratiokat- amik egy egyedelőforduláshoz tartoznak, hogy egyszerre egy komment csak egyszer legyen kilistázva, mellette kollektívan a ratio tábla lényege
    //látszik hogy egy kommentnek milyen egy kommentnek az értéke(felhasználók által)
    //IFNULL, ha egy komment még nem lenne értékelve akkor NULL érték helyett 0-t tudunk adni neki így ha ki akarjuk írni ez sem fog hibát okozni.


    while ($commentRow = mysqli_fetch_array($queriedComments)) {
        $commentField .= "<div id=\"{$commentRow['comment_id']}\" class=\"comment flexrow littleGap\">
        <div class=\"leftside\">
        <div class=\"rating flexrow littleGap\">
        <div class=\"ratingValue\">{$commentRow['ratio']}</div>
        <div class=\"ratingButtons flexcol\">";
        
        $RatioSQL = "SELECT * FROM `ratios` WHERE  commentID = {$commentRow['comment_id']} AND userID = {$userData['userID']}";
        $queriedRatio = mysqli_query($conn, $RatioSQL);
    //elkezdünk végigmenni a lekért kommenteken és mindegyik kommenthez lekérjük az adatbázisból a hozzá tartozó like- okat és dislike- okat
                
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
                    //Ez a kódsor a like, dislike gombok megjelenéséért felel, ha a belépett felhasználó interaktált egy kommenten ezekkel (like -ot, vagy dislike -ot adott) akkor azt megfelelően beszinezi
                    //ha a like -ot adott akkor azt a stringet adja hozzá a komment php változóhoz amiben a html kód tartalmazza azt a classt ami a like gomb szinezéséért felel
                    //ha dislike-ot akkor azt,  ha meg nem interaktált még a felhasználó a jelen vizsgált kommentel akkor alap kinézettel kerül oda.
                    $commentField.="
                    </div>
                </div>
            </div>
            <div class=\"rightside flexcol\">
                <div class=\"nameAndDate flexrow littleGap\">
                    <img class=\"commentAvatar\" src=\"{$commentRow['avatar']}\" alt=\"\">
                    <h2 class=\"commenter-name\"><a href=\"profile.php?user=".$commentRow['nev']."&userid=".$commentRow['user_id']."\"class=\"\">{$commentRow['nev']}</a></h2>
                    <h4 class= \"comment-date\">{$commentRow['date']}</h4>
                </div>
                <div class=\"content\">
                    <p>{$commentRow['text']}</p>
                </div>
            </div>";
            // felépítjük a kommentet, benne lesz a user avatárja, neve, küldés dátuma, és maga az üzenet.

            if ($userData['userID'] == $pageData['id'] || $commentRow['user_id'] == $userData['userID']) {
                $commentField .= "<div class=\"kuka\"><i class=\"fa fa-trash\"></i></div>";
                
            }
            //ha a felhasználó a saját profilján van, VAGY a vizsgált komment a saját kommentje, kirakjuk a kukát, amivel tudja az adott kommentet törölni
            $commentField .="
        </div>";
    } 
}

//ˇˇˇˇ következő szekcióban a scriptek vannak amik a külömböző eseményeket kezelik amik a komment szekcióban történnek. Ezeket szintén a komment változóba tesszük egy html script tagen belül.

$commentField .= "</div>

</div>
</section>
<script type=\"text/javascript\">
let {$sendComment} = document.getElementById(\"{$sendComment}\");
let {$commentInput} = document.getElementById(\"{$commentInput}\");


{$sendComment}.addEventListener('click',function $functName(event){
    event.preventDefault();
    if ({$commentInput}.value != \"\") {
        {$sendComment}.removeEventListener('click',$functName);
        let dataForPHP = new FormData();
        dataForPHP.append(\"madeOn\", {$pageData['id']});
        dataForPHP.append(\"text\", {$commentInput}.value);
        dataForPHP.append(\"type\", \"{$pageData['type']}\");
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
    

    function Enter(event){
        if (event.keyCode == 13)
        {
            if (!event.shiftKey)
            {
                {$sendComment}.click();
            }
            return false;
        }
    }


    let upbuttons = document.querySelectorAll(\".upbutton\");
    let downbuttons = document.querySelectorAll(\".downbutton\");
    function PushVotes(element,like,dislike,val,stat=\"\"){
        let parentID = element.parentElement.parentElement.parentElement.parentElement.id;
        let ratio = \"\";
        if (stat == \"plus\") {
            if (like.classList.contains(\"liked\")) {
                val.innerHTML = parseInt(val.innerHTML) -1;
                like.classList.remove(\"liked\");
                ratio = 0;
            }
            else if(dislike.classList.contains(\"disliked\"))
            {
                val.innerHTML = parseInt(val.innerHTML) +2;
                dislike.classList.remove(\"disliked\");
                like.classList.add(\"liked\");
                ratio = 1;
            }
            else{
                val.innerHTML = parseInt(val.innerHTML) +1;
                dislike.classList.remove(\"disliked\");
                like.classList.add(\"liked\");
                ratio = 1;
            }
        }
        else if (stat == \"minus\") {
            if (dislike.classList.contains(\"disliked\")) {
                val.innerHTML = parseInt(val.innerHTML) +1;
                dislike.classList.remove(\"disliked\");
                ratio = 0;
            }
            else if(like.classList.contains(\"liked\"))
            {
                val.innerHTML = parseInt(val.innerHTML) -2;
                like.classList.remove(\"liked\");
                dislike.classList.add(\"disliked\");
                ratio = -1;
            }
            else{
                val.innerHTML = parseInt(val.innerHTML) -1;
                like.classList.remove(\"liked\");
                dislike.classList.add(\"disliked\");
                ratio = -1;
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
            console.log(data);
            if (data == \"NOPLIZ\") {
            }
            else if(data == \"GANTZ\"){
                console.log(\"hiba van\")
            }
        })
        .catch(error => console.log(error));
        
    }
    for (let i = 0; i < upbuttons.length; i++) {
        upbuttons[i].addEventListener('click',() => PushVotes(upbuttons[i],upbuttons[i].parentElement.firstElementChild.firstElementChild,upbuttons[i].parentElement.lastElementChild.firstElementChild,upbuttons[i].parentElement.parentElement.firstChild.nextSibling,\"plus\"));
        downbuttons[i].addEventListener('click',() => PushVotes(downbuttons[i],downbuttons[i].parentElement.firstElementChild.firstElementChild,downbuttons[i].parentElement.lastElementChild.firstElementChild,downbuttons[i].parentElement.parentElement.firstChild.nextSibling,\"minus\"));
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
                element.parentElement.remove();
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


// 117-144 elősször megnézzük hogy üres e a komment input mező és csak akkor haladunk tovább ha nem az.
//létrehozunk egy formdata változót és hozzá adjuk a komment adatait: mi alá került a komment: a játék vagy felhasználó idje; a típusa: játék vagy felhasználó alá került; és magát az üzenetet.
//fetch apival meghívjuk a pushcomment.php filet post metódussal átadjuk neki a formDatát.
//a pushComment file ezeket a post-olt form adatokat várja.


//147-156 Komment írásakor enterrel el lehet küldeni a kommentet de shift + enterrel új sort kezdünk.

//159-203 A like és dislikeokat kezeli, ha már be van like olva akkor le veszi róla és levon egyet a számból, ugyan ez a dislike val csak ott hozzá ad, ha meg likeről rakja át dislike ra akkor
//kettőt von ki (1- le veszi a like ott, és még 1, rárakja a dislikeot). Ugyan ez a dislikeről like ra csak ott 2-t ad

//206 - 229. Itt az előbb történt módosítást az adatbázisba is fel rakja, Ezt is egy fetch apival ami ugyan azt a filrt hívja meg csak más paramétereket küld a form datában.

//231 - 254 A kommentek törléséért felel. Ez a backend része a fentebb létrehozott kukáknak. Ezt is a fetcht használja.
echo $commentField;
?>
