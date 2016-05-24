<?php
namespace Strebo\SocialNetworks;

use Strebo;
use SoundCloud\Client as SoundCloudAPI;

class SoundCloud extends Strebo\AbstractSocialNetwork implements Strebo\PrivateInterface, Strebo\PublicInterface
{

    private $client = null;
    private $public = false;

    public function __construct()
    {
        parent::__construct(
            'SoundCloud',
            'soundcloud',
            '#ff3a00',
            ["DE" => null, "US" => null, "W" => null],
            getenv('strebo_soundcloud_1'),
            getenv('strebo_soundcloud_2'),
            'http://strebo.net?SoundCloud=1'
        );
        $this->client = new SoundCloudAPI($this->getApiKey(), $this->getApiSecret(), $this->getApiCallback());
    }

    public function connect($code)
    {
        $response = json_decode($this->client->post(
            "https://api.soundcloud.com/oauth2/token",
            ["client_id" => $this->getApiKey(),
                "client_secret" => $this->getApiSecret(),
                "grant_type" => "authorization_code",
                "redirect_uri" => $this->getApiCallback(),
                "code" => $code[0]]
        ));

        $oauthSoundCloud = new SoundCloudAPI($this->getApiKey(), $this->getApiSecret(), $this->getApiCallback());
        $oauthSoundCloud->setAccessToken($response->access_token);
        return [$response->access_token, $oauthSoundCloud];


    }

    public function getPersonalFeed($user)
    {
        $oauthSoundCloud = $user->getClient($this->getName());
        $this->public = false;
        return $this->encodeJSON($oauthSoundCloud->get("https://api.soundcloud.com/me/favorites"));
    }


    public function search($tag)
    {
        $this->public = false;
        return $this->encodeJSON($this->client->get('https://api.soundcloud.com/tracks', [$tag]));
    }

    public function getPublicFeed($location)
    {
        $this->public = true;
        return $this->encodeJSON(file_get_contents('https://api-v2.soundcloud.com/charts?genre=soundcloud%3Agenres%3Aall-music&query_urn=soundcloud%3Acharts%3A5cbb6b10abdd41f3beec23c6c5b886da&offset=20&kind=top&limit=20&client_id=02gUJC0hH2ct1EGOcYXQIzRFU91c72Ea&app_version=1460122160'));
    }

    public function encodeJSON($json)
    {

        $data = json_decode($json, true);
        $tempSong = [];
        $feed = [];

        if ($this->public) {
            foreach ($data["collection"] as $song) {
                $tempSong["text"] = $song["track"]["description"];
                $tempSong["title"] = $song["track"]["title"];
                $tempSong["author"] = $song["track"]["user"]["username"];
                $tempSong["authorPicture"] = $song["track"]["user"]["avatar_url"];
                $tempSong["numberOfLikes"] = $song["track"]["likes_count"];
                $tempSong["link"] = $song["track"]["permalink_url"];
                $tempSong["type"] = "audio";
                $tempSong["createdTime"] = $this->formatTime($song["track"]["created_at"]);
                $tempSong["media"] = $song["track"]["uri"] . '?client_id=d08c99a67fa0518806f5fe1f4bf36792';
                $tempSong["thumb"] = $song["track"]["artwork_url"];
                $match = [];
                preg_match_all('/(\\"[A-Za-z0-9\s]+\\"|[A-Za-z0-9]+)/', $song["track"]["tag_list"], $match);
                $tempSong["tags"] = null;
                for ($i = 1; $i < count($match); $i++) {
                    $tempSong["tags"] = str_replace("\"", "", $match[$i]);
                }
                $feed[] = $tempSong;
                $tempSong = [];
            }
        }
        if (!$this->public) {
            foreach ($data as $song) {
                $tempSong["text"] = $song["description"];
                $tempSong["title"] = $song["title"];
                $tempSong["author"] = $song["user"]["username"];
                $tempSong["authorPicture"] = $song["user"]["avatar_url"];
                $tempSong["numberOfLikes"] = null;
                $tempSong["link"] = $song["permalink_url"];
                $tempSong["type"] = "audio";
                $tempSong["createdTime"] = $this->formatTime($song["created_at"]);
                $tempSong["media"] = $song["stream_url"] . '?client_id=d08c99a67fa0518806f5fe1f4bf36792';
                $tempSong["thumb"] = $song["artwork_url"];
                $tempSong["tags"] = null;
                $match = [];
                preg_match_all('/(\\"[A-Za-z0-9\s]+\\"|[A-Za-z0-9]+)/', $song["track"]["tag_list"], $match);
                $tempSong["tags"] = null;
                for ($i = 1; $i < count($match); $i++) {
                    $tempSong["tags"] = $match[$i];
                }
                $feed[] = $tempSong;
                $tempSong = [];
            }
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

    public function isTokenValid($user)
    {
        try {
            $oauthSoundCloud = $user->getClient($this->getName());
            if ($oauthSoundCloud != null) {
                json_decode($oauthSoundCloud->get("https://api.soundcloud.com/me/favorites"));
            }
        } catch (\Exception $e) {
            $user->removeToken($this->getName());
            $user->removeClient($this->getName());
        }
    }
}
