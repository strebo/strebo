<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

    // Make sure composer dependencies have been installed
    require __DIR__ . '/vendor/autoload.php';

    // Run the server application through the WebSocket protocol on port 8080
    $app = new Ratchet\App('localhost', 8080);
    $app->route('/echo', new Ratchet\Server\EchoServer, array('*'));
    $app->run();
?>