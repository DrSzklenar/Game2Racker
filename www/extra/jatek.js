let container = document.getElementById("container");

game = document.createElement("div");
game.id = 'gameContainer';
game.innerHTML = `
<div id="gameArea">
    <input type="number" name="gameCounter" id="gameCounter" min="1" value="1" disabled>
    <div id="ball"></div>
</div>
`;
document.body.insertBefore(game,document.body.childNodes[0]);

game = document.createElement("div");
game.id = 'playTheGameBTN';
game.innerHTML = `
<input id="gameButton" type="button" value="Játék!">
`;

document.body.insertBefore(game,document.body.childNodes[0]);

var styles = `
    #gameContainer *{
      user-select: none;
      -webkit-user-drag: none
    }

    #gameContainer{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        place-items: center;
        
    }

    #playTheGameBTN{
        position: fixed;
        bottom: 0px;
        left: 0px;
        z-index: 600;
    }

    #gameArea{
        position: relative;
        display: none;
        width: 60%;
        height: 80%;
        border: 1rem solid black;
        background-color: gray;
    }

    .shown{
        display: grid !important;
        z-index: 500;
    }

    #gameCounter{
        position: absolute;
        top: 0px;
    }

    #ball{
        background-color: #006699;
        margin: 0 auto;
        width: 500px;
        height: 300px;
        position: relative;
        box-shadow: inset 0 0 20px #155;
        border-radius: 20px;
        border: 1px solid #111;
        overflow: hidden;
        cursor: pointer;
      }
      #ball{
        display: block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #999999;
        box-shadow: inset -5px -5px 5px rgba(0,0,0,.6), 15px 15px 2px rgba(0,0,0,.04);
        position: absolute;
        -webkit-animation: moveX 3s linear 0s infinite alternate, moveY 3.4s linear 0s infinite alternate;
        -moz-animation: moveX 3s linear 0s infinite alternate, moveY 3.4s linear 0s infinite alternate;
        -o-animation: moveX 3s linear 0s infinite alternate, moveY 3.4s linear 0s infinite alternate;
        animation: moveX 3s linear 0s infinite alternate, moveY 3.4s linear 0s infinite alternate;
      }
      
      @-webkit-keyframes moveX {
        from { left: 0; } to { left: 480px; }
      }
      @-moz-keyframes moveX {
        from { left: 0; } to { left: 1480px; }
      }
      @-o-keyframes moveX {
        from { left: 0; } to { left: 780px; }
      }
      @keyframes moveX {
        from { left: 0; } to { left: calc(100% - 2rem); }
      }
      
      @-webkit-keyframes moveY {
        from { top: 0; } to { top: calc(100% - 2rem); }
      }
      @-moz-keyframes moveY {
        from { top: 0; } to { top: calc(100% - 2rem); }
      }
      @-o-keyframes moveY {
        from { top: 0; } to { top: calc(100% - 2rem); }
      }
      @keyframes moveY {
        from { top: 0; } to { top: calc(100% - 2rem); }
      }

`

var styleSheet = document.createElement("style")
styleSheet.innerText = styles
document.head.appendChild(styleSheet);

let playButton = document.getElementById("playTheGameBTN");
let gameArea = document.getElementById("gameArea");
let gameContainer = document.getElementById("gameContainer");
let gameCounter = document.getElementById("gameCounter");
let ball = document.getElementById("ball");

playButton.addEventListener("click",() => {
    gameArea.classList.toggle("shown");
    gameContainer.classList.toggle("shown");
});

ball.addEventListener("click",() => {
    gameCounter.value = parseInt(gameCounter.value) + 1;
});