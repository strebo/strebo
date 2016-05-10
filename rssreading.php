<?php

require 'vendor/autoload.php';

use PicoFeed\Reader\Reader;

try {

    $reader = new Reader;
    $resource = $reader->download('https://www.bing.com/news?format=RSS');

    //var_dump($resource);

    $parser = $reader->getParser(
        $resource->getUrl(),
        $resource->getContent(),
        $resource->getEncoding()
    );

    $feed = $parser->execute();

    if ($feed->items[0]->hasNamespace('News')) {
        foreach($feed->items as $index => $value) {
            $image = $value->getTag('News:Image')[0];
            $source = $value->getTag('News:Source')[0];
            $title = $value->getTag('title')[0];
            $description = $value->getTag('description')[0];
            $pubDate = $value->getTag('pubDate')[0];
            $link = $value->getTag('link')[0];
            print_r ($image);
            print_r($source);
            print_r($title);
            print_r($description);
            print_r($link);
            print_r($pubDate);
        }
    }
}
catch (Exception $e) {
    // Do something...
}
