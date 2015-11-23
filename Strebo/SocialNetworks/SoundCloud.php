<?php
namespace Strebo\SocialNetworks;
use Strebo;

class SoundCloud extends Strebo\AbstractSocialNetwork implements Strebo\PublicInterface{

public function __construct(){
		parent::__construct('SoundCloud','soundcloud','#ff3a00');
}

public function connect($code){

}

public function getPersonalFeed(){

	$feed;
	return $this->encodeJSON($feed);

}


public function search($tag) {

}

public function getPublicFeed() {
	/*$ch = curl_init('http://api-v2.soundcloud.com/explore/Popular+Music?tag=out-of-experiment&limit=10&offset=0&linked_partitioning=1&client_id=d08c99a67fa0518806f5fe1f4bf36792');
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($ch);
	curl_close($ch);*/
	/*echo $curl;
	var_dump($curl);
	echo curl_getinfo($init) . '<br/>';
	echo curl_errno($init) . '<br/>';
	echo curl_error($init) . '<br/>';*/

	return $this->encodeJSON(file_get_contents('http://api-v2.soundcloud.com/explore/Popular+Music?tag=out-of-experiment&limit=24&offset=0&linked_partitioning=1&client_id=d08c99a67fa0518806f5fe1f4bf36792'));

}

public function encodeJSON($json){

	$data = json_decode($json, true);
	$i = 0;
	$temp_song = [];

	foreach($data["tracks"] as $song) {
		$temp_song["text"] = $song["description"];
		$temp_song["author"] = $song["user"]["username"];
		$temp_song["authorPicture"] = $song["user"]["avatar_url"];
		$temp_song["numberOfLikes"] = $song["likes_count"];
		$temp_song["link"] = $song["permalink_url"];
		$temp_song["type"] = "audio";
		$temp_song["createdTime"] = $this->formatTime($song["created_at"]);
		$temp_song["media"] = $song["stream_url"] . '?client_id=d08c99a67fa0518806f5fe1f4bf36792';
		$temp_song["thumb"] = $song["artwork_url"];
		$feed[$i] = $temp_song;
		$temp_song = [];
		$i++;
	}

	$newJSON=array('name'=>parent::getName(),
				'icon'=>parent::getIcon(),
				'color'=>parent::getColor(),
				'feed'=>$feed);

	return json_encode($newJSON);
}

public function formatTime($time)
    {
        $timeJSON = array('day' => substr($time, 8, 2),
            'month' => substr($time, 5,2),
            'year' => substr($time, 0,4),
            'hour' => substr($time, 11, 2),
            'minute' => substr($time, 14, 2),
            'second' => substr($time, 17, 2)
        );

        return json_encode($timeJSON);

    }
}

?>
