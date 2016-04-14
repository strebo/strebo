<?php

require_once 'Autoloader.php';
spl_autoload_register (array ('Autoloader', 'autoload'));

putenv('strebo_instagram_1=c12bbe37871f443ca257ef54a131a777');
putenv('strebo_twitter_1=3872089625-xRvrn2Qb8QG5GDtrskVFy1E1wQAgQPpX5xsFKZa');
putenv('strebo_twitter_2=rnGWYxMdQJmj4Q5YdddNC2EUPhKffSvcj3WhBzOjSiO8a');
putenv('strebo_twitter_3=BspGfBzzXbBKtdWpl0eL1cihi');
putenv('strebo_twitter_4=I3ht3hDmG0vY2uTb32WaupyKQq7Rv0htaGW8x2DDhd5ExrNij9');
putenv('strebo_soundcloud_1=b44373de55ef0a0048ff5de51c143db6');
putenv('strebo_soundcloud_2=9b305fb370cf50d4a8d63d745c894d44');

echo "\n".'  Welcome at strebo.
              _            _
             | |          | |
          ___| |_ _ __ ___| |__   ___
         / __| __| \'__/ _ \ \'_ \ / _ \
         \__ \ |_| | |  __/ |_) | (_) |
         |___/\__|_|  \___|_.__/ \___/'."\n\n\n";

$strebo = new \Strebo\StreboServer("0.0.0.0", "8080");

try {
$strebo->run();
} catch (Exception $e) {
$strebo->stdout($e->getMessage());
}

?>