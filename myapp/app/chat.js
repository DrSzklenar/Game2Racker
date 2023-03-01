const ws = new WebSocket("ws:87.229.6.116:5500");

// chat  
let chatForm = document.getElementById('chatForm');
let messageinput = document.getElementById('messageinput');
let nevinput = document.getElementById('nevinput');
let reciever = document.getElementById('reciever');

let nevek = ['atrasuluj','Tron','BleachII','rainpour','lolBeardlol','NitroHead','Facer','footboalgundog2010','Zapp_Ackerman','ClownDown','sO_cRaZY','malter_ego','Flo_rida','CircleOFgambit','sinple','creamybridget2000','mrmrmrmrmrmDream','boga_discorda','[WORT]Tron','(Fin)[Ich]LINE','Rand00m','LUSERNAME','massEker','Killua_Ackerman','astabonkus','helL-TAKER','unhinged','tomatonator','DeathMauler','TripL4SH','quanter2','DJErrickCion','Fluper_Kukker','2000fortitudes','Ping[WIN]HARCOS','Ultimater','BrapperFarter','RayZin','giveUP','Raptor_csapat','ComicLoop','screwshit','frog_lover','MCbendO','a[TOMI]c','Zerohero','pvpROCKYROCKY','emerardo sprasho','plaxbales','killfuck','BGPsortofin','Suhajda_Bokkit','coatshangerAsh','kukudlack','femboy_hater','Yuto_on_Pluto','[N/A]EmptyNull','WhiteStoneSun','Tnya_4_7rechauf','noisy_hair','KOROSHI_black','pedro_sharingan','SupersonicWereRU','Zennie_tspringer','BUSTARRR','PixelMania','owoDash','sayitAprit','dave','Radoooo','Mieruko_Garage','Finngasch','Von_Zugg_suja','Babiden_Bettebon','KilluaLovesJews','Chorogon','Rokuro_x_Benio','Mr_Byn','ratty_memes_wtf','PROpeller','Schulletlen','Lemon3McGuk','hurkerDiusker'];

let nev = "";
let uzi = "";
let roomid = "111";

// youtube
let linkInput = document.getElementById("loadVideoById");
let PlayPause = document.getElementById("PlayPause");
let isPaused = true;
let ytvideoState = document.getElementById("ytvideoState");


var tag = document.createElement('script');
var startTime = -1;
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[1];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;                   
// You Tube player object


ws.addEventListener("open", (event) => {
    event.preventDefault();
    if (localStorage.getItem("nev") === null) {
        nev = nevek[Math.floor(Math.random() * nevek.length)];
        localStorage.setItem("nev", nev);
        console.log("mostantól " + nev + " a neved");
        nevinput.value = nev;
    }
    else{
        nev = localStorage.getItem("nev");
        nevinput.value = nev;
    }
    console.log("We are connected! " + nev);
    ws.send(JSON.stringify({
        msgType: "connect",
        adat: roomid
    }));
});
//A websocket open eventjén ez a function fut le. Ez akkor történik amikor egy kliens csatlakozik a websocket serverhez
//Egy random név generálásával kezd ha még még nincs név elmentve
//localstorage-ba menti


nevinput.addEventListener("blur", nameSave);
//ha ki kattint a név inputjából akkor el menti


function nameSave() {
    console.log("kragabenoritoggen");
    if (nevinput.value == "") {
        nev = nevek[Math.floor(Math.random() * nevek.length)];
        nevinput.value = nev;
        localStorage.setItem("nev",nev);
    }
    else
    {
        
        nev = nevinput.value;
        localStorage.setItem("nev",nev);
        console.log("mostantól " + nev + " a neved");
    }
}
//Ha név mentésekor éppen üres a mező akkor random generál egy nevet a nevek tömbből.
//A nevet localstorage-ben tárolja




chatForm.addEventListener("submit", (e) => {
    e.preventDefault();
    uziRot = `<b>${nev}:</b> ${messageinput.value}`;
    uzi = uziRot.replace(/felx/gi,'hurka');
    sendAmessage(uzi);
    messageinput.value = '';
});
//Clickelés a chatForm submit gombája fel tölt egy változót a messageinput nevű input értékével és az eltárolt névvel.
//Ezután meghívja a sendAmessage functiont az uzenettel paraméterként és törli az input tartalmát.



function sendAmessage(paramAdat) {
    ws.send(JSON.stringify({
        msgType: "msg",
        adat: paramAdat
    }));
}
//Stringgé alakít egy json objektumot és meghívja a websocketsbe beépített send funkciót ami egy string-et küld
//A stringgé alakított json jelenleg 2 tulajdonsággal rendelkezik: msgType: az üzenet típusa. ami most üzenet típusú
//És adat: ami most az üzenet tartalma lesz

function recieveAmessage(text) {
    if (Math.abs(reciever.scrollHeight - reciever.clientHeight - reciever.scrollTop) <= 20) {
        console.log("works");
        reciever.innerHTML += `<p class="uzenet">${text}</p><br>`;
        reciever.lastChild.scrollIntoView();
    }
    else{
        
        reciever.innerHTML += `<p class="uzenet">${text}</p><br>`;
    }

}
//Ennek a functionnak a paramétere a websockettől kapott üzenet lesz.
//Ha a csevegőablak alján jár a felhasználó akkor lejebb teker, ha nincs a tetején akkor nem ugrik, hogy a felhasználó
//megszakításmentesen olvashassa a korábbi üzeneteket

ws.addEventListener("message", (event) => {
    let ballsData = JSON.parse(event.data);
    console.log(event);
    switch (ballsData.msgType) {
        //case user:
        //function listusers
        case "msg":
            recieveAmessage(ballsData.adat);
            break;
        case "video":
            VidRecieve(ballsData.adat);
            break;
        case "action":
            if (ballsData.adat == "pause") {
                // player.pauseVideo();
                jsPlayer.play()
                isPaused = true;
            }
            else{
                // player.playVideo();
                jsPlayer.pause();
                isPaused = false;
            }
            break;
        case "connect":

            break;
        
        default:
            break;
    }
});
//A websocketnek a message eventjéhez egy event listenert adunk.
//elősször egy változóba kerül magának az eventnek az adatai. amit egy jsonná változtatunk
//Egy switch ami az előbb megadott msgType tulajdonságot vizsgálja, a megfelelő functiont meg hívja az adat tulajdonság értékével.


// chat end



// When You Tube API is ready, create a new 
// You Tube player in the div with id 'player'
// function onYouTubeIframeAPIReady() {
//     player = new YT.Player('player_div',
//         {
//             videoId: 'Dfv8qgrQNKk',   // Load the initial video
//             playerVars: {
//                 autoplay: 1,      // Don't autoplay the initial video
//                 rel: 0,           //  Don’t show related videos
//                 theme: "light",   // Use a light player instead of a dark one
//                 controls: 1,      // Show player controls
//                 showinfo: 0,      // Don’t show title or loader
//                 modestbranding: 1, // No You Tube logo on control bar
//                 enablejsapi: 1
//             },
//             events: {
//                 // Callback when onReady fires
//                 onReady: onReady,

//                 // Callback when onStateChange fires
//                 onStateChange: onStateChange,

//                 // Callback when onError fires
//                 onError: onError
//             }
//         });

// }
// Callback specified to process the onReady event has been received
// so can proceed with creating and managing You Tube player(s)


//Ez a youtube player ért felel. publikusan elérhető a youtube api oldalán

// Log state changes
// function onReady(event) {
//     player.playVideo();
//     console.log("Kaklanafffffffff");
//     setTimeout(function () {
//         player.pauseVideo();
//     }, 700);
//     event.target.setVolume(5);
//     $('#PlayPause').click(function (event) {
//         if (isPaused == false) {
//             ws.send(JSON.stringify({
//                 msgType: "action",
//                 adat: "pause"
//             }));

//         }
//         else {
//             ws.send(JSON.stringify({
//                 msgType: "action",
//                 adat: "play"
//             }));
//         }
        
//     });
//     ytvideoState.innerText = player.getPlayerState();
// }

$('#PlayPause').click(function (event) {
        if (isPaused == false) {
            ws.send(JSON.stringify({
                msgType: "action",
                adat: "pause"
            }));

        }
        else {
            ws.send(JSON.stringify({
                msgType: "action",
                adat: "play"
            }));
        }
        
    });

// 4. The API calls this function when the player's state changes.
// function onStateChange(event) {
//     ytvideoState.innerText = player.getPlayerState();
//     if (player.getPlayerState == '-1') {
//         event.player.playVideo();
//         event.player.playVideo();
//         event.player.playVideo();
//         console.log("puraein");
//     }
// }



// Log any errors
// function onError(event) {
//     var error = "undefined";
//     switch (event.data) {
//         case 2:
//             error = "Invalid parameter value";
//             break;
//         case 5:
//             error = "HTML 5 related error";
//             break;
//         case 100:
//             error = "Video requested is not found";
//             break;
//         case 101:
//             error = "Embedded playback forbidden by ownder";
//             break;
//         case 150:
//             error = "Error processing video request";
//             break;
//         default:
//             error = "unknown (" + event.data + ")";
//     }

// }


// linkForm.addEventListener("submit", (e) => {
//     e.preventDefault();
//     VidSend();
//     messageinput.value = '';
// });

let jsLinkPutter = document.getElementById("jsLinkPutter");
let VideoJsLoadVid = document.getElementById("VideoJsLoadVid");
console.log(jsLinkPutter);

let jsPlayer = videojs('myVideoJs');


jsLinkPutter.addEventListener("submit", (e) =>{
    e.preventDefault();
    VidSend();
});


function JsPlayThis(videoURL) {
    jsPlayer.src({ type: "video/youtube", src: videoURL});
    jsPlayer.load();
    isPaused = false;
    // jsPlayer.play();
}

function VidSend() {
    ws.send(JSON.stringify({
        msgType: "video",
        // adat: linkInput.value
        adat: VideoJsLoadVid.value
    }));
}
function VidRecieve(data) {
    // player.loadVideoById({ videoId: data });
    JsPlayThis(data);
    document.getElementById('myVideoJs').click();
}

document.getElementById('myVideoJs').addEventListener('click', () => {
    console.log("Baszás!");
});