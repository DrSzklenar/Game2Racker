const http = require('http');
const fs = require('fs');
// let arr = [];
const express = require('express');
const app = express();

app.use(express.static('app'));

app.get('/app/index.html', function (req, res) {
    res.end
});

// Change the 404 message modifing the middleware
app.use(function(req, res, next) {
    res.status(404).send("Sorry, that route doesn't exist. Have a nice day :)");
});

// start the server in the port 3000 !
app.listen(80, function () {
    console.log('App started on port 80');
});


const WebSocket = require("ws");
const { json } = require('body-parser');

const wss = new WebSocket.Server({ port: 5500 });



wss.on("connection", ws => {
    console.log("Client has connected");

    // ws.on("open", () => {
    //     console.log("what is happen!!!!!!!!!");
        
    //     wss.clients.forEach( (client) => {
    //         i++;
    //         let name = "Guest" + i;
    //         client.send(name);
    //         console.log(`Mostantól a csatlakozott kliens neve: ${name}`);   
    //     });
    // });


    
    


    ws.on("message", data => {
        const ballsData = JSON.parse(data);
        console.log(`Client has sent: ${data}`);
        
        wss.clients.forEach( (client) => {
            // client.send(ballsData.msgType,ballsData.adat);
            client.send(JSON.stringify({msgType : ballsData.msgType, adat: ballsData.adat}));
        });

    });


    ws.on("close", () => {
        console.log("Client has disconnected");
    });
});


