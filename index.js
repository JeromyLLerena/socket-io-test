var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.get('/', function(req, res){
  res.sendfile('index.html');
});

io.on('connection', function(socket){
  socket.on('disconnect', function(){
    console.log('user disconnected');
  });
  socket.on('chat message', function(data){
    console.log(data);
    io.emit('chat message', data);
  });
  socket.on('writing', function(value){
  socket.broadcast.emit('writing', value + ' is typing...');
  });
});

http.listen(3000, function(){
  console.log('listening on *:3000');
});
