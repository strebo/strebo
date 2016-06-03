<?php

require __DIR__ . '/vendor/autoload.php';

putenv('strebo_instagram_1=c12bbe37871f443ca257ef54a131a777');
putenv('strebo_instagram_2=036f0eeacf054448a7c31e58860e453e');
putenv('strebo_twitter_1=3872089625-3bsbrrk6FMLhKEGDQfoLe1pVHD0puhhrrCWywIC');
putenv('strebo_twitter_2=TMnxXLMiaAJj57UC1oLABy2keaDoH8Vrl0YX2VoQasZnV');
putenv('strebo_twitter_3=BspGfBzzXbBKtdWpl0eL1cihi');
putenv('strebo_twitter_4=I3ht3hDmG0vY2uTb32WaupyKQq7Rv0htaGW8x2DDhd5ExrNij9');
putenv('strebo_soundcloud_1=b44373de55ef0a0048ff5de51c143db6');
putenv('strebo_soundcloud_2=9b305fb370cf50d4a8d63d745c894d44');
putenv('strebo_youtube_1=AIzaSyAH6n3wcnku2Ah3qZZrgWbXcxVgiAwF-Xk');
putenv('strebo_youtube_2=AIzaSyA8OMzoY6nuaQyQyp3nDSqVpMbjL6juT8U');
putenv('strebo_youtube_3=993593787738-d877dvu5186gm7bu6kbkbl4oamneev28.apps.googleusercontent.com');
putenv('strebo_youtube_4=z293VhHYUA23m6yDpTYh41Bn');
putenv('strebo_facebook_1=112533202499343');
putenv('strebo_facebook_2=c01e0c4c83726c0a7825a8bb737e056b');

echo "\n" . '  Welcome at strebo.
              _            _
             | |          | |
          ___| |_ _ __ ___| |__   ___
         / __| __| \'__/ _ \ \'_ \ / _ \
         \__ \ |_| | |  __/ |_) | (_) |
         |___/\__|_|  \___|_.__/ \___/' . "\n\n\n";

$strebo = new \Strebo\StreboServer("0.0.0.0", "8080");

try {
    $strebo->run();
} catch (Exception $e) {
    $strebo->stdout($e->getMessage());
    echo("An error occures!\nTrying to restart the script...");
    exit(0);
}
