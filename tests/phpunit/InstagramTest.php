<?php

/**
 * Created by PhpStorm.
 * User: PARSEA
 * Date: 20.04.2016
 * Time: 17:45
 */

require __DIR__ .'/../../vendor/autoload.php';
require __DIR__ .'/../../Autoloader.php';

spl_autoload_register (array ('Autoloader', 'autoload'));

class InstagramTest extends PHPUnit_Framework_TestCase
{
    public function testConnect(){
        // TO BE DONE
    }

    public function testGetPublicFeed()
    {
        putenv('strebo_instagram_1=c12bbe37871f443ca257ef54a131a777');
        $instagram=new \Strebo\SocialNetworks\Instagram();
        $result=json_decode($instagram->getPublicFeed([null,null]));
        echo(var_dump($result));
        $this->assertEquals("Instagram",$result->name);
        $this->assertEquals("instagram",$result->icon);
        $this->assertEquals("#2a5b83",$result->color);
        $this->assertArrayHasKey("type",$result->feed[0]);
        $this->assertArrayHasKey("tags",$result->feed[0]);
        $this->assertArrayHasKey("title",$result->feed[0]);
        $this->assertArrayHasKey("createdTime",$result->feed[0]);
        $this->assertArrayHasKey("link",$result->feed[0]);
        $this->assertArrayHasKey("author",$result->feed[0]);
        $this->assertArrayHasKey("authorPicture",$result->feed[0]);
        $this->assertArrayHasKey("numberOfLikes",$result->feed[0]);
        $this->assertArrayHasKey("media",$result->feed[0]);
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
        putenv('strebo_instagram_1=c12bbe37871f443ca257ef54a131a777');
        $instagram=new \Strebo\SocialNetworks\Instagram();
        $time=json_decode($instagram->formatTime("1296656006"));

        $this->assertEquals("02",$time->day);
        $this->assertEquals("02",$time->month);
        $this->assertEquals("2011",$time->year);
        $this->assertEquals("15",$time->hour);
        $this->assertEquals("13",$time->minute);
        $this->assertEquals("26",$time->second);
    }
}
