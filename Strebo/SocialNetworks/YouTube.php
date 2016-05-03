<?php

namespace Strebo\SocialNetworks;

use Strebo;

class YouTube extends Strebo\AbstractSocialNetwork implements Strebo\PrivateInterface, Strebo\PublicInterface
{
    private $youtube;
    private $googlePlus;
    private $client;
    private $client2;

    public function __construct()
    {
        parent::__construct('YouTube', 'youtube', '#e62117', 'DE', 'US', null);
        $this->apiKey = getenv('strebo_youtube_1');
        $this->client = new \Google_Client();
        $this->client->setApplicationName("strebo_youtube");
        $this->client->setDeveloperKey($this->apiKey);
        $this->youtube = new \Google_Service_YouTube($this->client);
        $this->client2 = new \Google_Client();
        $this->client2->setApplicationName("strebo_google_plus");
        $this->client2->setDeveloperKey(getenv("strebo_youtube_2"));
        $this->googlePlus = new \Google_Service_Plus($this->client2);
    }

    public function connect($code)
    {

    }

    public function getPersonalFeed()
    {
        // TODO: Implement getPersonalFeed() method.
    }

    public function search($tag)
    {
        return $this->encodeJSON($this->youtube->search->listSearch("snippet", ["maxResults" => 20, "q" => $tag]));
    }

    public function getPublicFeed($location)
    {
        if ($location != null) {
            $popularMedia = $this->youtube->videos->listVideos("snippet,statistics", ["chart" => "mostPopular", "regionCode" => $location, "maxResults" => 20]);
        } else {
            $popularMedia = $this->youtube->videos->listVideos("snippet,statistics", ["chart" => "mostPopular", "maxResults" => 20]);
        }
        return $this->encodeJSON($popularMedia);
    }

    public function encodeJSON($json)
    {
        $feed = [];

        foreach ($json->items as $item) {

            $data = [];
            $data['type'] = "video";
            $data['tags'] = $item->snippet->tags;
            $data['createdTime'] = $this->formatTime($item->snippet->publishedAt);

            if (isset($item->id->videoId)) {
                $id = $item->id->videoId;
            } else {
                $id = $item->id;
            }

            $data['link'] = "https://www.youtube.com/watch?v=" . $id;
            $data['author'] = $item->snippet->channelTitle;
            $channel = $this->youtube->channels->listChannels("contentDetails", ["id" => $item->snippet->channelId]);
            $profile = $this->googlePlus->people->get($channel->items[0]->contentDetails->googlePlusUserId);
            $data['authorPicture'] = null;
            if (isset($profile->image)) {
                $data['authorPicture'] = $profile->image->url;
            }
            $data['numberOfLikes'] = null;
            if (isset($item->statistics)) {
                $data['numberOfLikes'] = $item->statistics->likeCount;
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

    public function formatTime($time)
    {

        date_default_timezone_set('Europe/Berlin');

        $formattedTime = date('d m Y H i s', strtotime($time));

        $timeJSON = array('day' => substr($formattedTime, 0, 2),
            'month' => substr($formattedTime, 3, 2),
            'year' => substr($formattedTime, 5, 5),
            'hour' => substr($formattedTime, 11, 2),
            'minute' => substr($formattedTime, 14, 2),
            'second' => substr($formattedTime, 17)
        );

        return json_encode($timeJSON);
    }

}