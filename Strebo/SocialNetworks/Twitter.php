<?php
namespace Strebo\SocialNetworks;
use Strebo;

require __DIR__ . '/../AbstractSocialNetwork.php';

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
        // TODO: Implement search() method.
    }

    public function getPublicFeed()
    {
        $this->url = 'https://api.twitter.com/1.1/trends/place.json';
        $this->requestMethod = "GET";
        $this->getfield = '?id=1';

        $trendsresult = $this->twitter->setGetfield($this->getfield)
            ->buildOauth($this->url, $this->requestMethod)
            ->performRequest();

        $trends;
        $i = 0;

        $trendsresult=json_decode($trendsresult);

        foreach ($trendsresult[0]->trends as $trend) {
            $trends[$i] = $trend->query;
            $i++;
        }

        $this->url = 'https://api.twitter.com/1.1/search/tweets.json';


        $trendingTweets;
        $j=0;

        foreach ($trends as $trend) {
            $this->getfield = '?q=' . $trend . '&result_type=popular';

           $trendingTweets[$j]=json_decode($this->twitter->setGetfield($this->getfield)
                ->buildOauth($this->url, $this->requestMethod)
                ->performRequest());

            $j++;
        }

        return $this->encodeJSON($trendingTweets);


    }

    public function encodeJSON($json)
    {

        $feed;
        $i = 0;

        foreach ($json as $tweets) {
            foreach ($tweets->statuses as $tweet) {
                    $data;
                    $data['tags'] = $tweet->entities->hashtags;
                    $data['createdTime'] = $tweet->created_at;
                    $data['text'] = $tweet->text;
                    $data['author'] = $tweet->user->name;
                    $data['authorPicture'] = $tweet->user->profile_image_url;
                    $data['numberOfLikes'] = $tweet->favorite_count;
                    $feed[$i] = $data;
                    $i++;

            }
        }
        $newJSON = array('name' => parent::getName(),
            'icon' => parent::getIcon(),
            'color' => parent::getColor(),
            'feed' => $feed);

        return json_encode($newJSON);
    }
}

?>