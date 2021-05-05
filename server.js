//const express = require('express');
const app = require('express')();
const http = require('http').Server(app);
app.use(require('cors')())
const io = require('socket.io')(http);
const users = [];

http.listen(8005, function() {
    console.log('listening to port 8005')
});

io.on('connection', function (socket) {

  socket.on("user_connected", function (user_id) {
    users[user_id] = socket.id;
    io.emit('UpdateUserStatus', users);
    console.log("user_connected "+ user_id);

  });

});