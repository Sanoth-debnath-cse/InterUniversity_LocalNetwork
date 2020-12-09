var express = require('express');
var app =express();
var server =require('http').createServer(app);
var io =require('socket.io').listen(server);
users =[];
connection=[];

server.listen(process.env.PORT || 3000);

console.log('Server running...');

app.get('/',function (req,res) {
    res.sendFile(__dirname + '/index.html');


});

io.sockets.on('connection', function (socket) {
    connection.push(socket);
    console.log('connected: %s sockets connected',connection.length);

    //disconnected
    socket.on('disconnect',function (data) {
        connection.splice(connection.indexOf(socket),1);
        console.log('Disconnected: %s sockets connected',connection.length);

    });

    // send message
    socket.on('send message',function (data) {

        io.sockets.emit('new message',{msg: data});
    });


});

