<?php
namespace Strebo\SocialNetworks;
use Strebo;
use SoundCloud\Client as SoundCloudAPI;

class SoundCloud extends Strebo\AbstractSocialNetwork implements Strebo\PrivateInterface, Strebo\PublicInterface
{

    private $client = null;
    private $search = false;

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

    public function getPersonalFeed($token)
    {

        $feed;
        return $this->encodeJSON($feed);

    }


    public function search($tag)
    {
        $this->search = true;
        return $this->encodeJSON($this->client->get('https://api.soundcloud.com/tracks', [$tag]));
    }

    public function getPublicFeed($location)
    {
        return $this->encodeJSON(file_get_contents('https://api-v2.soundcloud.com/charts?genre=soundcloud%3Agenres%3Aall-music&query_urn=soundcloud%3Acharts%3A5cbb6b10abdd41f3beec23c6c5b886da&offset=20&kind=top&limit=20&client_id=02gUJC0hH2ct1EGOcYXQIzRFU91c72Ea&app_version=1460122160'));
    }

    public function encodeJSON($json)
    {

        $data = json_decode($json, true);
        $temp_song = [];
        $feed = [];

        if (!$this->search) {
            foreach ($data["collection"] as $song) {
                $temp_song["text"] = $song["track"]["description"];
                $temp_song["title"] = $song["track"]["title"];
                $temp_song["author"] = $song["track"]["user"]["username"];
                $temp_song["authorPicture"] = $song["track"]["user"]["avatar_url"];
                $temp_song["numberOfLikes"] = $song["track"]["likes_count"];
                $temp_song["link"] = $song["track"]["permalink_url"];
                $temp_song["type"] = "audio";
                $temp_song["createdTime"] = $this->formatTime($song["track"]["created_at"]);
                $temp_song["media"] = $song["track"]["uri"] . '?client_id=d08c99a67fa0518806f5fe1f4bf36792';
                $temp_song["thumb"] = $song["track"]["artwork_url"];
                $match=[];
                preg_match_all('/(\\"[A-Za-z0-9\s]+\\"|[A-Za-z0-9]+)/',$song["track"]["tag_list"],$match);
                $temp_song["tags"] = null;
                for($i=1;$i<count($match);$i++){
                    $temp_song["tags"]=$match[$i];
                }
                $feed[] = $temp_song;
                $temp_song = [];
            }
        } else {
            foreach ($data as $song) {
                $temp_song["text"] = $song["description"];
                $temp_song["title"] = $song["title"];
                $temp_song["author"] = $song["user"]["username"];
                $temp_song["authorPicture"] = $song["user"]["avatar_url"];
                $temp_song["numberOfLikes"] = null;
                $temp_song["link"] = $song["permalink_url"];
                $temp_song["type"] = "audio";
                $temp_song["createdTime"] = $this->formatTime($song["created_at"]);
                $temp_song["media"] = $song["stream_url"] . '?client_id=d08c99a67fa0518806f5fe1f4bf36792';
                $temp_song["thumb"] = $song["artwork_url"];
                $temp_song["tags"] = null;
                $match=[];
                preg_match_all('/(\\"[A-Za-z0-9\s]+\\"|[A-Za-z0-9]+)/',$song["track"]["tag_list"],$match);
                $temp_song["tags"] = null;
                for($i=1;$i<count($match);$i++){
                    $temp_song["tags"]=$match[$i];
                }
                $feed[] = $temp_song;
                $temp_song = [];
            }
            $this->search = false;
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
