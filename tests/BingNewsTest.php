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
        $this->assertEquals("newspaper-o", $result->icon);
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
        // TO BE DONE
    }
}
