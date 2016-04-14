var conn = new WebSocket('ws://localhost:8080/echobot');

conn.onmessage = function(e) {
    console.log(e.data);
};

conn.onopen = function () {
    conn.send('Ping'); // Send the message 'Ping' to the server
};
