<?php
namespace Strebo\SocialNetworks;

use Strebo;

use Symfony\Component\Config\Definition\Exception\Exception;
use TwitterAPIExchange;

//use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter extends Strebo\AbstractSocialNetwork implements Strebo\PublicInterface
{

    private $url;
    private $twitter;
    private $requestMethod;
    private $getfield;

    public function __construct()
    {
        parent::__construct(
            'Twitter',
            'twitter',
            '#4099FF',
            ["DE" => "23424829", "US" => "23424977", "W" => "1"],
            getenv('strebo_twitter_3'),
            getenv('strebo_twitter_4'),
            null
        );

        $accessToken = getenv('strebo_twitter_1');
        $tokenSecret = getenv('strebo_twitter_2');

        $settings = array(
            'oauth_access_token' => $accessToken,
            'oauth_access_token_secret' => $tokenSecret,
            'consumer_key' => $this->getApiKey(),
            'consumer_secret' => $this->getApiSecret()
        );

        $this->twitter = new TwitterAPIExchange($settings);
    }

    /*public function connect($code)
    {


        $connection = new TwitterOAuth($this->getApiKey(), $this->getApiSecret());
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $this->getApiCallback()));
        $connection = new TwitterOAuth(
            $this->getApiKey(),
            $this->getApiSecret(),
            $request_token['oauth_token'],
            $request_token['oauth_token_secret']
        );
        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $code[1]]);
        var_dump($request_token);
        var_dump($access_token);

        $connection = new TwitterOAuth(
            $this->getApiKey(),
            $this->getApiSecret(),
            $access_token['oauth_token'],
            $access_token['oauth_token_secret']
        );


        return [$access_token, $connection];
    }

    public function getPersonalFeed($user)
    {
        $oauthTwitter = $user->getClient($this->getName());
        $this->url = 'https://api.twitter.com/1.1/statuses/home_timeline.json';
        $this->requestMethod = "GET";
        $this->getfield = '?count=50';

        return $this->encodeJSON($oauthTwitter->setGetfield($this->getfield)
            ->buildOauth($this->url, $this->requestMethod)
            ->performRequest());

    }*/

    public function search($tag)
    {
        $this->url = 'https://api.twitter.com/1.1/search/tweets.json';
        $this->requestMethod = "GET";
        $this->getfield = '?q=' . $tag;

        $result = $this->twitter->setGetfield($this->getfield)
            ->buildOauth($this->url, $this->requestMethod)
            ->performRequest();

        $result = json_decode($result);

        if (array_key_exists("errors", $result)) {
            return null;
        }

        return $this->encodeJSON($result);
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

        $trendsresult = json_decode($trendsresult);

        if (array_key_exists("errors", $trendsresult)) {
            return null;
        }

        foreach ($trendsresult[0]->trends as $trend) {
            $trends[] = $trend->query;
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

    }

    public function encodeJSON($json)
    {
        $feed = [];

        foreach ($json as $tweets) {
            if (!isset($tweets->statuses)) {
                return null;
            }
            foreach ($tweets->statuses as $tweet) {
                $data = [];
                $data['tags'] = [];
                foreach ($tweet->entities->hashtags as $hashtag) {
                    $data['tags'][] = $hashtag->text;
                }
                $data['createdTime'] = parent::formatTime(strtotime($tweet->created_at));
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
                }
                if (!isset($tweet->entities->media)) {
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
}
