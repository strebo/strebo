<?php

/**
 * @coversDefaultClass Strebo\SocialNetworks\YouTube
 */

require __DIR__ .'/../../vendor/autoload.php';
require __DIR__ .'/../../Autoloader.php';

spl_autoload_register (array ('Autoloader', 'autoload'));

class YouTubeTest extends PHPUnit_Framework_TestCase
{

    public function testConnect(){
        // TO BE DONE
    }

    public function testGetPublicFeed()
    {
        putenv('strebo_youtube_1=AIzaSyAH6n3wcnku2Ah3qZZrgWbXcxVgiAwF-Xk');
        putenv('strebo_youtube_2=AIzaSyA8OMzoY6nuaQyQyp3nDSqVpMbjL6juT8U');
        $youtube=new \Strebo\SocialNetworks\YouTube();
        $result=json_decode($youtube->getPublicFeed([null,null]));
        $this->assertEquals("YouTube",$result->name);
        $this->assertEquals("youtube",$result->icon);
        $this->assertEquals("#2a5b83",$result->color);
        $this->assertObjectHasAttribute("type",$result->feed[0]);
        $this->assertObjectHasAttribute("tags",$result->feed[0]);
        $this->assertObjectHasAttribute("title",$result->feed[0]);
        $this->assertObjectHasAttribute("createdTime",$result->feed[0]);
        $this->assertObjectHasAttribute("link",$result->feed[0]);
        $this->assertObjectHasAttribute("author",$result->feed[0]);
        $this->assertObjectHasAttribute("authorPicture",$result->feed[0]);
        $this->assertObjectHasAttribute("numberOfLikes",$result->feed[0]);
        $this->assertObjectHasAttribute("media",$result->feed[0]);
    }

    public function testGetPersonalFeed(){
        // TO BE DONE
    }

    public function testSearch()
    {
        // TO BE DONE
    }

    public function testEncodeJSON(){
        // TO BE DONE
    }

    public function testFormatTime(){
        putenv('strebo_youtube_1=AIzaSyAH6n3wcnku2Ah3qZZrgWbXcxVgiAwF-Xk');
        putenv('strebo_youtube_2=AIzaSyA8OMzoY6nuaQyQyp3nDSqVpMbjL6juT8U');
        $youtube=new \Strebo\SocialNetworks\YouTube();
        $time=json_decode($youtube->formatTime("1296656006"));

        $this->assertEquals("02",$time->day);
        $this->assertEquals("02",$time->month);
        $this->assertEquals("2011",$time->year);
        $this->assertEquals("15",$time->hour);
        $this->assertEquals("13",$time->minute);
        $this->assertEquals("26",$time->second);
    }
}

}
