<?php

/**
 * @coversDefaultClass Strebo\SocialNetworks\FourChan
 */
class FourChanTest extends PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        // TO BE DONE
    }

    public function testGetPublicFeed()
    {
        $fourChan = new \Strebo\SocialNetworks\FourChan();
        $result = json_decode($fourChan->getPublicFeed(null));
        $this->assertEquals("4chan", $result->name);
        $this->assertEquals("chanx1", $result->icon);
        $this->assertEquals("#789922", $result->color);
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
        $chan = new \Strebo\SocialNetworks\FourChan();
        $time=json_decode($chan->formatTime(1448638702));
        $this->assertEquals("27", $time->day);
        $this->assertEquals("11", $time->month);
        $this->assertEquals("2015", $time->year);
        $this->assertEquals("15", $time->hour);
        $this->assertEquals("38", $time->minute);
        $this->assertEquals("22", $time->second);

    }
}

