var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);

app.get('/', (req, res) => {
  console.log(req.query.value);
  res.sendFile(__dirname + '/chat.html');
});

io.on('connection', (socket) => {
  console.log('a user connected');
});

// http.listen(3000, () => {
//   console.log('listening on *:3000');
// });

io.on('connection', (socket) => {
  console.log('a user connected');
  socket.on('disconnect', () => {
    console.log('user disconnected');
  });
});

io.on('connection', (socket) => {
  socket.on('chat message', (msg) => {
    console.log('message: ' + msg);
  });
});

io.emit('some event', { someProperty: 'some value', otherProperty: 'other value' }); // This will emit the event to all connected socket
io.on('connection', (socket) => {
  socket.broadcast.emit('hi');
});
io.on('connection', (socket) => {
  socket.on('chat message', (msg) => {
    io.emit('chat message', msg);
  });
});