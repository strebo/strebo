<?php

/**
 * @coversDefaultClass Strebo\SocialNetworks\Twitter
 */

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../Autoloader.php';

spl_autoload_register(array('Autoloader', 'autoload'));

class TwitterTest extends PHPUnit_Framework_TestCase
{

    public function testConnect()
    {
        // TO BE DONE
    }

    public function testGetPublicFeed()
    {
        putenv('strebo_twitter_1=3872089625-xRvrn2Qb8QG5GDtrskVFy1E1wQAgQPpX5xsFKZa');
        putenv('strebo_twitter_2=rnGWYxMdQJmj4Q5YdddNC2EUPhKffSvcj3WhBzOjSiO8a');
        putenv('strebo_twitter_3=BspGfBzzXbBKtdWpl0eL1cihi');
        putenv('strebo_twitter_4=I3ht3hDmG0vY2uTb32WaupyKQq7Rv0htaGW8x2DDhd5ExrNij9');;
        $twitter = new \Strebo\SocialNetworks\Twitter();
        $result = json_decode($twitter->getPublicFeed("1"));
        if ($result != null) {
            $this->assertEquals("Twitter", $result->name);
            $this->assertEquals("twitter", $result->icon);
            $this->assertEquals("#4099FF", $result->color);
            $this->assertObjectHasAttribute("type", $result->feed[0]);
            $this->assertObjectHasAttribute("tags", $result->feed[0]);
            $this->assertObjectHasAttribute("title", $result->feed[0]);
            $this->assertObjectHasAttribute("createdTime", $result->feed[0]);
            $this->assertObjectHasAttribute("link", $result->feed[0]);
            $this->assertObjectHasAttribute("author", $result->feed[0]);
            $this->assertObjectHasAttribute("authorPicture", $result->feed[0]);
            $this->assertObjectHasAttribute("numberOfLikes", $result->feed[0]);
            $this->assertObjectHasAttribute("media", $result->feed[0]);
        } else {
            $this->assertEquals(null, $result);
        }
    }

    public function testGetPersonalFeed()
    {
        // TO BE DONE
    }

    public function testSearch()
    {
        // TO BE DONE
    }

    public function testEncodeJSON()
    {
        // TO BE DONE
    }

    public function testFormatTime()
    {
        putenv('strebo_twitter_1=3872089625-xRvrn2Qb8QG5GDtrskVFy1E1wQAgQPpX5xsFKZa');
        putenv('strebo_twitter_2=rnGWYxMdQJmj4Q5YdddNC2EUPhKffSvcj3WhBzOjSiO8a');
        putenv('strebo_twitter_3=BspGfBzzXbBKtdWpl0eL1cihi');
        putenv('strebo_twitter_4=I3ht3hDmG0vY2uTb32WaupyKQq7Rv0htaGW8x2DDhd5ExrNij9');
        $twitter = new \Strebo\SocialNetworks\Twitter();
        $time = json_decode($twitter->formatTime("Mon Sep 24 03:35:21 +0000 2012"));

        $this->assertEquals("24", $time->day);
        $this->assertEquals("09", $time->month);
        $this->assertEquals("2012", $time->year);
        $this->assertEquals("03", $time->hour);
        $this->assertEquals("35", $time->minute);
        $this->assertEquals("21", $time->second);
    }
}
