<?php

/**
 * @coversDefaultClass Strebo\SocialNetworks\BingNews
 */

require __DIR__ . '/../vendor/autoload.php';

class BingNewsTest extends PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        // TO BE DONE
    }

    public function testGetPublicFeed()
    {
        $bing = new \Strebo\SocialNetworks\BingNews();
        $result = json_decode($bing->getPublicFeed(null));
        $this->assertEquals("Bing News", $result->name);
        $this->assertEquals("Bing_logo_2016", $result->icon);
        $this->assertEquals("#008273", $result->color);
        $this->assertObjectHasAttribute("type", $result->feed[0]);
        //$this->assertObjectHasAttribute("tags", $result->feed[0]);
        $this->assertObjectHasAttribute("title", $result->feed[0]);
        //$this->assertObjectHasAttribute("thumb", $result->feed[0]);
        $this->assertObjectHasAttribute("createdTime", $result->feed[0]);
        $this->assertObjectHasAttribute("link", $result->feed[0]);
        $this->assertObjectHasAttribute("author", $result->feed[0]);
        //$this->assertObjectHasAttribute("authorPicture", $result->feed[0]);
        //$this->assertObjectHasAttribute("numberOfLikes", $result->feed[0]);
        //$this->assertObjectHasAttribute("media", $result->feed[0]);
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
        $bing = new \Strebo\SocialNetworks\BingNews();
        $time=json_decode($bing->formatTime(strtotime("Thu, 09 Jun 2016 23:59:00 GMT")));

        $this->assertEquals("09", $time->day);
        $this->assertEquals("06", $time->month);
        $this->assertEquals("2016", $time->year);
        $this->assertEquals("23", $time->hour);
        $this->assertEquals("59", $time->minute);
        $this->assertEquals("00", $time->second);

    }
}
