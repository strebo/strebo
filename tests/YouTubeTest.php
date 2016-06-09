<?php

/**
 * @coversDefaultClass Strebo\SocialNetworks\YouTube
 */

require __DIR__ . '/../vendor/autoload.php';

class YouTubeTest extends PHPUnit_Framework_TestCase
{

    public function testConnect()
    {
        // TO BE DONE
    }

    public function testGetPublicFeed()
    {
        putenv('strebo_youtube_1=AIzaSyAH6n3wcnku2Ah3qZZrgWbXcxVgiAwF-Xk');
        putenv('strebo_youtube_2=AIzaSyA8OMzoY6nuaQyQyp3nDSqVpMbjL6juT8U');
        $youtube = new \Strebo\SocialNetworks\YouTube();
        $result = $youtube->getPublicFeed(null);
        if ($result != null) {
            $result = json_decode($youtube->getPublicFeed(null));
            $this->assertEquals("YouTube", $result->name);
            $this->assertEquals("youtube", $result->icon);
            $this->assertEquals("#e62117", $result->color);
            $this->assertObjectHasAttribute("type", $result->feed[0]);
            $this->assertObjectHasAttribute("tags", $result->feed[0]);
            $this->assertObjectHasAttribute("title", $result->feed[0]);
            $this->assertObjectHasAttribute("createdTime", $result->feed[0]);
            $this->assertObjectHasAttribute("link", $result->feed[0]);
            $this->assertObjectHasAttribute("author", $result->feed[0]);
            $this->assertObjectHasAttribute("authorPicture", $result->feed[0]);
            $this->assertObjectHasAttribute("numberOfLikes", $result->feed[0]);
            $this->assertObjectHasAttribute("media", $result->feed[0]);
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
        putenv('strebo_youtube_1=AIzaSyAH6n3wcnku2Ah3qZZrgWbXcxVgiAwF-Xk');
        putenv('strebo_youtube_2=AIzaSyA8OMzoY6nuaQyQyp3nDSqVpMbjL6juT8U');
        $youtube = new \Strebo\SocialNetworks\YouTube();
        $time = json_decode($youtube->formatTime(strtotime("2016-04-25T13:00:09.000Z")));

        $this->assertEquals("25", $time->day);
        $this->assertEquals("04", $time->month);
        $this->assertEquals("2016", $time->year);
        $this->assertEquals("13", $time->hour);
        $this->assertEquals("00", $time->minute);
        $this->assertEquals("09", $time->second);
    }
}
