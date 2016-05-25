<?php
namespace Strebo\SocialNetworks;

use Strebo;

class FourChan extends Strebo\AbstractSocialNetwork implements Strebo\PublicInterface
{

    public function __construct()
    {
        parent::__construct(
            '4chan',
            'chanx1',
            '#789922',
            ["DE" => null, "US" => null, "W" => null],
            null,
            null,
            null
        );
    }

    public function search($tag)
    {
       return null;
    }

    public function getPublicFeed($location)
    {
        return $this->encodeJSON(file_get_contents('https://a.4cdn.org/news/1.json'));
    }

    public function encodeJSON($json)
    {

        $data = json_decode($json, true);
        $feed = [];

        foreach ($data["threads"] as $gitem) {
        	if($gitem["posts"][0]["resto"] == 0) {
	            $item = [];
	            if(isset($gitem["posts"][0]["sub"])) { $item["title"] = $gitem["posts"][0]["sub"]; }
	            $item["author"] = $gitem["posts"][0]["name"];
	            $item["text"] = $gitem["posts"][0]["com"];
	            $item["link"] = "https://boards.4chan.org/news/thread/" . $gitem["posts"][0]["no"];
	            if(isset($gitem["posts"][0]["tim"])) {
	            	$item["media"] = "https://i.4cdn.org/news/" . $gitem["posts"][0]["tim"] . "" . $gitem["posts"][0]["ext"];
	            	$item["type"] = 'image';
	            	if($gitem["posts"][0]["ext"] == ".webm") {$item["type"] = 'video';}
	            } else {
	            	$item["type"] = 'text';
	            }
	            $item["createdTime"] = $this->formatTime($gitem["posts"][0]["time"]);
	            array_push($feed, $item);
        	}
        }

        $newJSON = array('name' => parent::getName(),
            'icon' => parent::getIcon(),
            'color' => parent::getColor(),
            'customIcon' => true,
            'feed' => $feed);

        return json_encode($newJSON);
    }

    public function formatTime($time) {
    	return json_encode(array('day' => date("d",$time),
            'month' => date("m",$time),
            'year' => date("Y",$time),
            'hour' => date("H",$time),
            'minute' => date("i",$time),
            'second' => date("s",$time)
        ));
    }
}
