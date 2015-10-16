<?php
use Strebo\StreboServer;

    $host = 'localhost';
    $port = '8080';

    // Get composer dependencies
    require __DIR__ . '/vendor/autoload.php';
    require 'autoload.php';
    autoload('Strebo\StreboServer');

    echo "\n".'  Welcome at strebo.
              _            _
             | |          | |
          ___| |_ _ __ ___| |__   ___
         / __| __| \'__/ _ \ \'_ \ / _ \
         \__ \ |_| | |  __/ |_) | (_) |
         |___/\__|_|  \___|_.__/ \___/'."\n";

    // Run the server application
    $app = new Ratchet\App($host, $port);
    $app->route('/strebo', new StreboServer(), array('*'));

    echo "\n".'   Server configured as ' . $host . ':' . $port . "\n\n";

    $app->run();
?>