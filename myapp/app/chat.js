const ws = new WebSocket("ws:87.229.6.116:5500");




// window.onload = () => {
    
// };

// chat  
let chatForm = document.getElementById('chatForm');
let messageinput = document.getElementById('messageinput');
let nevtorles = document.getElementById('nevtorles');
let nevinput = document.getElementById('nevinput');
let button = document.getElementById('gomb');
let reciever = document.getElementById('reciever');

let nev = "";
let uzi = "";

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

var player;                   // You Tube player object


ws.addEventListener("open", (event) => {
    // event.preventDefault();
    console.log("We are connected!");
    if (localStorage.getItem("nev") == null) {
        // init variable/set default variable for item
        localStorage.setItem("nev",event.name);
    }
    else{
        nev = localStorage.getItem("nev");
        console.log("mostantól " + nev + " a neved");
    }

});


button.addEventListener("click", () => {
    nev = nevinput.value;
    localStorage.setItem("nev",nev);
    console.log("mostantól " + nev + " a neved");
});
nevtorles.addEventListener("click", () => {
    localStorage.clear();
    console.log("mostantól " + nev + " a neved");
});






chatForm.addEventListener("submit", (e) => {
    e.preventDefault();
    uzi = `<b>${nev}:</b> ${messageinput.value}`;
    sendAmessage(uzi);
    messageinput.value = '';
});

function sendAmessage(paramAdat) {
    ws.send(JSON.stringify({
        msgType: "msg",
        adat: paramAdat
    }));
    // uzitarolas(uzi);
   
            $("#reciever").animate({ scrollTop: 20000000 }, "slow");
}

// function uzitarolas(uzi) {
    
//     arr.push(uzi);
// }

function recieveAmessage(text) {
    reciever.innerHTML += `<p class="uzenet">${text}</p><br>`;
}


ws.addEventListener("message", (event) => {
    let ballsData = JSON.parse(event.data);
    console.log(event);
    switch (ballsData.msgType) {
        case "msg":
            recieveAmessage(ballsData.adat);
            break;
        case "video":
            VidRecieve(ballsData.adat);
            break;
        case "action":
            if (ballsData.adat == "pause") {
                player.pauseVideo();
                isPaused = true;
            }
            else{
                player.playVideo();
                isPaused = false;
            }
            break;
        
        default:
            break;
    }
    
    
    
});

// chat end





// When You Tube API is ready, create a new 
// You Tube player in the div with id 'player'
function onYouTubeIframeAPIReady() {
    player = new YT.Player('player_div',
        {
            videoId: 'Dfv8qgrQNKk',   // Load the initial video
            playerVars: {
                autoplay: 0,      // Don't autoplay the initial video
                rel: 0,           //  Don’t show related videos
                theme: "light",   // Use a light player instead of a dark one
                controls: 1,      // Show player controls
                showinfo: 0,      // Don’t show title or loader
                modestbranding: 0, // No You Tube logo on control bar
                enablejsapi: 1
            },
            events: {
                // Callback when onReady fires
                onReady: onReady,

                // Callback when onStateChange fires
                onStateChange: onStateChange,

                // Callback when onError fires
                onError: onError
            }
        });

}

// Callback specified to process the onReady event has been received
// so can proceed with creating and managing You Tube player(s)


// Log state changes
function onReady(event) {
    event.target.setVolume(5);
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
    ytvideoState.innerText = player.getPlayerState();
}

// 4. The API calls this function when the player's state changes.
function onStateChange(event) {
    ytvideoState.innerText = player.getPlayerState();
    if (player.getPlayerState == -1) {
        event.player.playVideo();
        event.player.playVideo();
        event.player.playVideo();
        console.log("puraein");
    }
}



// Log any errors
function onError(event) {
    var error = "undefined";
    switch (event.data) {
        case 2:
            error = "Invalid parameter value";
            break;
        case 5:
            error = "HTML 5 related error";
            break;
        case 100:
            error = "Video requested is not found";
            break;
        case 101:
            error = "Embedded playback forbidden by ownder";
            break;
        case 150:
            error = "Error processing video request";
            break;
        default:
            error = "unknown (" + event.data + ")";
    }

}

function submitLoadVideoById() {
    ws.send(linkInput.value);
}




linkForm.addEventListener("submit", (e) => {
    e.preventDefault();
    VidSend();
    messageinput.value = '';
});


function VidSend() {
    ws.send(JSON.stringify({
        msgType: "video",
        adat: linkInput.value
    }));
}
function VidRecieve(data) {
    player.loadVideoById({ videoId: data });
}

ws.addEventListener("video", e => {
    console.log(e.data);
    VidRecieve(e.data);
});


