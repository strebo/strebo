<?php
namespace Strebo\SocialNetworks;

use Strebo;

use Symfony\Component\Config\Definition\Exception\Exception;
use TwitterAPIExchange;

class Twitter extends Strebo\AbstractSocialNetwork implements Strebo\PrivateInterface, Strebo\PublicInterface
{

    private $url;
    private $twitter;
    private $requestMethod;
    private $getfield;

    public function __construct()
    {
        parent::__construct('Twitter', 'twitter', '#4099FF');
        $oauth_access_token = getenv('strebo_twitter_1');
        $oauth_access_token_secret = getenv('strebo_twitter_2');
        $consumer_key = getenv('strebo_twitter_3');
        $consumer_secret = getenv('strebo_twitter_4');

        $settings = array(
            'oauth_access_token' => $oauth_access_token,
            'oauth_access_token_secret' => $oauth_access_token_secret,
            'consumer_key' => $consumer_key,
            'consumer_secret' => $consumer_secret
        );

        $this->twitter = new TwitterAPIExchange($settings);
    }

    public function connect($code)
    {
        // TODO: Implement connect() method.
    }

    public function getPersonalFeed()
    {

    }

    public function search($tag)
    {
        $this->url = 'https://api.twitter.com/1.1/search/tweets.json';
        $this->requestMethod = "GET";
        $this->getfield = '?q=' . $tag;

        json_decode($this->twitter->setGetfield($this->getfield)
            ->buildOauth($this->url, $this->requestMethod)
            ->performRequest());
    }

    public function getPublicFeed($location)
    {
        $this->url = 'https://api.twitter.com/1.1/trends/place.json';
        $this->requestMethod = "GET";
        $this->getfield = '?id=' . $location;

        $trendsresult = $this->twitter->setGetfield($this->getfield)
            ->buildOauth($this->url, $this->requestMethod)
            ->performRequest();

        $trends = [];
        $i = 0;

        try {

            $trendsresult = json_decode($trendsresult);

            foreach ($trendsresult[0]->trends as $trend) {
                $trends[$i] = $trend->query;
                $i++;
            }

            $this->url = 'https://api.twitter.com/1.1/search/tweets.json';


            $trendingTweets = [];

            foreach ($trends as $trend) {
                $this->getfield = '?q=' . $trend . '&result_type=popular&count=2';

                $trendingTweets[] = json_decode($this->twitter->setGetfield($this->getfield)
                    ->buildOauth($this->url, $this->requestMethod)
                    ->performRequest());
            }
            return $this->encodeJSON($trendingTweets);
        } catch (Exception $e) {
            return null;
        }

    }

    public function encodeJSON($json)
    {
        $feed = [];

        foreach ($json as $tweets) {
            foreach ($tweets->statuses as $tweet) {
                $data = [];
                $data['tags'] = [];
                foreach ($tweet->entities->hashtags as $hashtag) {
                    $data['tags'][] = $hashtag->text;
                }
                $data['createdTime'] = $this->formatTime($tweet->created_at);
                $data['text'] = $tweet->text;
                $data['title'] = null;
                $data['link'] = 'https://twitter.com/statuses/' . $tweet->id_str;
                $data['author'] = $tweet->user->name;
                $data['authorPicture'] = $tweet->user->profile_image_url;
                $data['numberOfLikes'] = $tweet->favorite_count;

                if (isset($tweet->entities->media)) {
                    foreach ($tweet->entities->media as $media) {
                        $data['media'] = $media->media_url;
                    }
                    $data['type'] = 'image';
                } else {
                    $data['type'] = 'text';
                }

                $feed[] = $data;
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

        $month = 0;

        switch (substr($time, 4, 3)) {
            case 'Jan':
                $month = 1;
                break;
            case 'Feb':
                $month = 2;
                break;
            case 'Mar':
                $month = 3;
                break;
            case 'Apr':
                $month = 4;
                break;
            case 'May':
                $month = 5;
                break;
            case 'Jun':
                $month = 6;
                break;
            case 'Jul':
                $month = 7;
                break;
            case 'Aug':
                $month = 8;
                break;
            case 'Sep':
                $month = 9;
                break;
            case 'Oct':
                $month = 10;
                break;
            case 'Nov':
                $month = 11;
                break;
            case 'Dec':
                $month = 12;
                break;
        }

        $timeJSON = array('day' => substr($time, 8, 2),
            'month' => $month,
            'year' => substr($time, 26),
            'hour' => substr($time, 11, 2),
            'minute' => substr($time, 14, 2),
            'second' => substr($time, 17, 2)
        );

        return json_encode($timeJSON);

    }
}

?>
