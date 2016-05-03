<?php
namespace Strebo\SocialNetworks;
use Strebo;
use SoundCloud\Client as SoundCloudAPI;

class SoundCloud extends Strebo\AbstractSocialNetwork implements Strebo\PrivateInterface, Strebo\PublicInterface
{

    private $client = null;

    public function __construct()
    {
        parent::__construct('SoundCloud', 'soundcloud', '#ff3a00', null, null, null);
        $this->apiKey = getenv('strebo_soundcloud_1');
        $this->apiSecret = getenv('strebo_soundcloud_2');
        $this->apiCallback = 'http://strebo.net';
        $this->client = new SoundCloudAPI($this->apiKey, $this->apiSecret, $this->apiCallback);
    }

    public function connect($code)
    {

    }

    public function getPersonalFeed()
    {

        $feed;
        return $this->encodeJSON($feed);

    }


    public function search($tag)
    {
        $this->encodeJSON($this->client->get('https://api.soundcloud.com/tracks', [$tag]));
    }

    public function getPublicFeed($location)
    {
        return $this->encodeJSON(file_get_contents('http://api-v2.soundcloud.com/explore/Popular+Music?tag=out-of-experiment&limit=24&offset=0&linked_partitioning=1&client_id=d08c99a67fa0518806f5fe1f4bf36792'));
    }

    public function encodeJSON($json)
    {

        $data = json_decode($json, true);
        $temp_song = [];

        foreach ($data["tracks"] as $song) {
            $temp_song["text"] = $song["description"];
            $temp_song["title"] = $song["title"];
            $temp_song["author"] = $song["user"]["username"];
            $temp_song["authorPicture"] = $song["user"]["avatar_url"];
            $temp_song["numberOfLikes"] = $song["likes_count"];
            $temp_song["link"] = $song["permalink_url"];
            $temp_song["type"] = "audio";
            $temp_song["createdTime"] = $this->formatTime($song["created_at"]);
            $temp_song["media"] = $song["stream_url"] . '?client_id=d08c99a67fa0518806f5fe1f4bf36792';
            $temp_song["thumb"] = $song["artwork_url"];
            $temp_song["tags"] = null;
            $feed[] = $temp_song;
            $temp_song = [];
        }

        $newJSON = array('name' => parent::getName(),
            'icon' => parent::getIcon(),
            'color' => parent::getColor(),
            'feed' => $feed);

        return json_encode($newJSON);
    }

    public function formatTime($time)
    {
        $timeJSON = array('day' => substr($time, 8, 2),
            'month' => substr($time, 5, 2),
            'year' => substr($time, 0, 4),
            'hour' => substr($time, 11, 2),
            'minute' => substr($time, 14, 2),
            'second' => substr($time, 17, 2)
        );

        return json_encode($timeJSON);

    }
}

?>
