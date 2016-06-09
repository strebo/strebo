<?php

namespace Strebo\SocialNetworks;

use Strebo;
use Symfony\Component\Config\Definition\Exception\Exception;

class YouTube extends Strebo\AbstractSocialNetwork implements Strebo\PrivateInterface, Strebo\PublicInterface
{
    private $youtube;
    private $googlePlus;

    public function __construct()
    {
        parent::__construct(
            'YouTube',
            'youtube',
            '#e62117',
            ["DE" => 'DE', "US" => 'US', "W" => null],
            getenv('strebo_youtube_1'),
            null,
            "http://strebo.net?YouTube=1"
        );
        $this->youtube = $this->buildYoutube(null);
        $client = new \Google_Client();
        $client->setApplicationName("strebo_google_plus");
        $client->setDeveloperKey(getenv("strebo_youtube_2"));
        $this->googlePlus = new \Google_Service_Plus($client);
    }

    public function connect($code)
    {
        $oauthYoutube = $this->buildYoutube(["code" => $code[0]]);
        return [$oauthYoutube->getClient()->getAccessToken(), null];

    }

    public function getPersonalFeed($user)
    {
        try {
            $token = (array)$user->getAuthorizedToken($this->getName());
            $youtube = $this->buildYoutube(["token" => $token]);
            return $this->encodeJSON(
                $youtube->videos->listVideos(
                    "snippet,statistics",
                    ["myRating" => "like", "maxResults" => 50]
                )
            );
        } catch (\Google_Service_Exception $e) {
            $e->getMessage();
            return null;
        }
    }

    public function search($tag)
    {
        try {
            return $this->encodeJSON($this->youtube->search->listSearch("snippet", ["maxResults" => 50, "q" => $tag]));
        } catch (\Google_Service_Exception $e) {
            $e->getMessage();
            return null;
        }
    }

    public function getPublicFeed($location)
    {
        try {
            if ($location != null) {
                $popularMedia = $this->youtube->videos->listVideos(
                    "snippet,statistics",
                    ["chart" => "mostPopular",
                        "regionCode" => $location,
                        "maxResults" => 50]
                );
            }
            if ($location == null) {
                $popularMedia = $this->youtube->videos->listVideos(
                    "snippet,statistics",
                    ["chart" => "mostPopular",
                        "maxResults" => 50]
                );
            }
            return $this->encodeJSON($popularMedia);
        } catch (\Google_Service_Exception $exception) {
            $exception->getMessage();
            return null;
        }
    }

    public function encodeJSON($json)
    {
        $feed = [];

        foreach ($json->items as $item) {

            $data = [];
            $data['type'] = "video";
            $data['tags'] = $item->snippet->tags;
            $data['createdTime'] = parent::formatTime(strtotime($item->snippet->publishedAt));

            if (isset($item->id->videoId)) {
                $id = $item->id->videoId;
            }
            if (!isset($item->id->videoId)) {
                $id = $item->id;
            }

            $data['link'] = "https://www.youtube.com/watch?v=" . $id;
            $data['author'] = $item->snippet->channelTitle;
            $channel = $this->youtube->channels->listChannels("contentDetails", ["id" => $item->snippet->channelId]);
            $profile = null;
            if (isset($channel->items[0]->contentDetails->googlePlusUserId)) {
                try {
                    $profile = $this->googlePlus->people->get($channel->items[0]->contentDetails->googlePlusUserId);
                } catch (\Google_Service_Exception $e) {
                    $profile = null;
                }
            }
            $data['authorPicture'] = null;
            if (isset($profile->image)) {
                $data['authorPicture'] = $profile->image->url;
            }
            $data['numberOfLikes'] = null;
            if (isset($item->statistics)) {
                $data['numberOfLikes'] = intval($item->statistics->likeCount);
            }

            $data['media'] = "https://www.youtube.com/embed/" . $id;
            $data['thumb'] = $item->snippet->thumbnails->default->url;
            $data['title'] = $item->snippet->title;
            $data['text'] = $item->snippet->description;

            $feed[] = $data;
        }

        $newJSON = array('name' => parent::getName(),
            'icon' => parent::getIcon(),
            'color' => parent::getColor(),
            'feed' => $feed);

        return json_encode($newJSON);
    }

    public function isTokenValid($user)
    {
        $token = (array)$user->getAuthorizedToken($this->getName());
        if ($token != null) {
            $client = $this->buildYoutube(["token" => $token]);
            if ($client->getClient()->isAccessTokenExpired()) {
                $user->removeAuthorizedToken($this->getName());
                $user->removeClient($this->getName());
            }
        }
    }

    public function buildYoutube($token)
    {
        $oauthClient = new \Google_Client();
        $oauthClient->setApplicationName("strebo");
        $oauthClient->setClientId(getenv("strebo_youtube_3"));
        $oauthClient->setClientSecret(getenv("strebo_youtube_4"));
        $oauthClient->setRedirectUri($this->getApiCallback());
        if (isset($token["code"])) {
            $tokenArray = $oauthClient->fetchAccessTokenWithAuthCode($token['code']);
            $oauthClient->setAccessToken($tokenArray);
        }
        if (isset($token["token"])) {
            $oauthClient->setAccessToken($token["token"]);
        }
        return new \Google_Service_YouTube($oauthClient);
    }
}
