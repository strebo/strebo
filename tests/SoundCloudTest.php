<?php

/**
 * @coversDefaultClass Strebo\SocialNetworks\SoundCloud
 */

require __DIR__ . '/../vendor/autoload.php';

class SoundCloudTest extends PHPUnit_Framework_TestCase
{

    public function testConnect()
    {
        // TO BE DONE
    }

    public function testGetPublicFeed()
    {
        putenv('strebo_soundcloud_1=b44373de55ef0a0048ff5de51c143db6');
        putenv('strebo_soundcloud_2=9b305fb370cf50d4a8d63d745c894d44');
        $soundcloud = new \Strebo\SocialNetworks\SoundCloud();
        $result = json_decode($soundcloud->getPublicFeed(null));
        $this->assertEquals("SoundCloud", $result->name);
        $this->assertEquals("soundcloud", $result->icon);
        $this->assertEquals("#ff3a00", $result->color);
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
        putenv('strebo_soundcloud_1=b44373de55ef0a0048ff5de51c143db6');
        putenv('strebo_soundcloud_2=9b305fb370cf50d4a8d63d745c894d44');
        $soundcloud = new \Strebo\SocialNetworks\SoundCloud();
        $time = json_decode($soundcloud->formatTime(strtotime("2016/01/29 10:57:05 +0000")));

        $this->assertEquals("29", $time->day);
        $this->assertEquals("01", $time->month);
        $this->assertEquals("2016", $time->year);
        $this->assertEquals("10", $time->hour);
        $this->assertEquals("57", $time->minute);
        $this->assertEquals("05", $time->second);
    }
}
