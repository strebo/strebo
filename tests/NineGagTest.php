<?php

/**
 * @coversDefaultClass Strebo\SocialNetworks\NineGag
 */
class NineGagTest extends PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        // TO BE DONE
    }

    public function testGetPublicFeed()
    {
        $nineGag = new \Strebo\SocialNetworks\NineGag();
        $result = json_decode($nineGag->getPublicFeed(null));
        $this->assertEquals("9GAG", $result->name);
        $this->assertEquals("GAG_new_logo", $result->icon);
        $this->assertEquals("#000000", $result->color);
        $this->assertObjectHasAttribute("type", $result->feed[0]);
        //$this->assertObjectHasAttribute("tags", $result->feed[0]);
        $this->assertObjectHasAttribute("title", $result->feed[0]);
        //$this->assertObjectHasAttribute("thumb", $result->feed[0]);
        $this->assertObjectHasAttribute("createdTime", $result->feed[0]);
        $this->assertObjectHasAttribute("link", $result->feed[0]);
        $this->assertObjectHasAttribute("author", $result->feed[0]);
        //$this->assertObjectHasAttribute("authorPicture", $result->feed[0]);
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
        // TO BE DONE
    }
}
