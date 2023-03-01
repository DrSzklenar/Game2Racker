const http = require('http');
const fs = require('fs');
// let arr = [];
const express = require('express');
const { body, validationResult } = require('express-validator');
const { json } = require('body-parser');
const app = express();
const routes = require('./routes');

app.set('view engine', 'ejs');

app.use(express.static('app'));
app.use(routes);


app.use(express.json());       
app.use(express.urlencoded({extended: true})); 
 

// Change the 404 message modifing the middleware
app.use(function(req, res, next) {
    res.status(404).send("Sorry, that route doesn't exist. Have a nice day :)");
});

// start the server in the port 3000 !
app.listen(80, function () {
    console.log('App started on port 80');
});



const WebSocket = require("ws");
const wss = new WebSocket.Server({ port: 5500 });

let activerooms = ['111','222'];
let clients = 

//beolvassa a neved


// wss.clients.forEach( (client) => {
//visszaküld egy 
// });

//







wss.on("connection", ws => {
    console.log("Client has connected");

    
    


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


