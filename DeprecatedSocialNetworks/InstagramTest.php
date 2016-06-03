<?php

/**
 * @coversDefaultClass Strebo\SocialNetworks\Instagram
 */

require __DIR__ . '/../vendor/autoload.php';

class InstagramTest extends PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        // TO BE DONE
    }

    public function testGetPublicFeed()
    {
        putenv('strebo_instagram_1=c12bbe37871f443ca257ef54a131a777');
        $instagram = new \Strebo\SocialNetworks\Instagram();
        $result = json_decode($instagram->getPublicFeed([null, null]));
        $this->assertEquals("Instagram", $result->name);
        $this->assertEquals("instagram", $result->icon);
        $this->assertEquals("#2a5b83", $result->color);
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
        putenv('strebo_instagram_1=c12bbe37871f443ca257ef54a131a777');
        $instagram = new \Strebo\SocialNetworks\Instagram();
        $time = json_decode($instagram->formatTime("1296656006"));

        $this->assertEquals("02", $time->day);
        $this->assertEquals("02", $time->month);
        $this->assertEquals("2011", $time->year);
        $this->assertEquals("14", $time->hour);
        $this->assertEquals("13", $time->minute);
        $this->assertEquals("26", $time->second);
    }
}
