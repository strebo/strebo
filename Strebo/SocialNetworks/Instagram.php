<?php
namespace Strebo\SocialNetworks;

use Strebo;

use MetzWeb\Instagram\Instagram as InstagramAPI;

class Instagram extends Strebo\AbstractSocialNetwork implements Strebo\PrivateInterface, Strebo\PublicInterface
{

    private $instagram;

    public function __construct()
    {
        parent::__construct(
            'Instagram',
            'instagram',
            '#2a5b83',
            ["51.1656910", "10.4515260"],
            ["37.0902400", "-95.7128910"],
            [null, null],
            getenv('strebo_instagram_1'),
            getenv('strebo_instagram_2'),
            'http://strebo.net'
        );
        $this->instagram = new InstagramAPI($this->getApiKey());

    }

    public function connect($code)
    {
        $privateInstagram = new InstagramAPI(array('apiKey' => $this->getApiKey(),
            'apiSecret' => $this->getApiSecret(),
            'apiCallback' => $this->getApiCallback()));
        $oAuthToken = $privateInstagram->getOAuthToken($code);
        $privateInstagram->setAccessToken($oAuthToken);
        return $privateInstagram;


    }

    public function getPersonalFeed($token)
    {
        $privateInstagram = $this->connect($token);
        $feed = $privateInstagram->getUserFeed(35);
        return $this->encodeJSON($feed);

    }


    public function search($tag)
    {
        $response = $this->instagram->getTagMedia($tag, 33);
        return $this->encodeJSON($response);

    }

    public function getPublicFeed($location)
    {
        if (!is_null($location[0])) {
            $popularmedia = $this->instagram->searchMedia($location[0], $location[1], 5000);
        }
        if (is_null($location[0])) {
            $popularmedia = $this->instagram->getPopularMedia();
        }
        return $this->encodeJSON($popularmedia);

    }

    public function encodeJSON($json)
    {
        $feed = [];
        foreach ($json->data as $media) {
            $data = [];
            $data['type'] = $media->type;
            $data['tags'] = $media->tags;
            $data['title'] = null;
            $data['createdTime'] = $this->formatTime($media->created_time);
            if (isset($media->caption, $media->caption->text)) {
                $data['text'] = $media->caption->text;
            }
            if (!isset($media->caption, $media->caption->text)) {
                $data['text'] = '';
            }
            $data['link'] = $media->link;
            $data['author'] = $media->user->username;
            $data['authorPicture'] = $media->user->profile_picture;
            $data['numberOfLikes'] = $media->likes->count;
            if ($media->type === 'image') {
                $data['media'] = $media->images->standard_resolution->url;
                $data['thumb'] = $media->images->thumbnail->url;
            } elseif ($media->type === 'video') {
                $data['media'] = $media->videos->standard_resolution->url;
            }
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
        $formattedTime = date('d m Y H i s', $time);

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
