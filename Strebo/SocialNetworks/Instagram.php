<?php
namespace Strebo\SocialNetworks;

use Strebo;

require __DIR__ . '/../AbstractSocialNetwork.php';

use MetzWeb\Instagram\Instagram as InstagramAPI;

class Instagram extends Strebo\AbstractSocialNetwork implements Strebo\PrivateInterface, Strebo\PublicInterface
{

    private $OAuthToken;
    private $instagram;

    public function __construct()
    {
        parent::__construct('Instagram', 'instagram', '#2a5b83');
        $this->apiKey = getenv('strebo_instagram_1');
        $this->instagram = new InstagramAPI ($this->apiKey);

    }

    public function connect($code)
    {
        $this->apiSecret = getenv('strebo_instagram_2');
        $this->apiCallback = 'http://strebo.net';
        $this->instagram = new InstagramAPI(array('apiKey' => $this->apiKey, 'apiSecret' => $this->apiSecret, 'apiCallback' => $this->apiCallback));
        $this->OAuthToken = $this->instagram->getOAuthToken($code);
        $this->instagram->setAccessToken($this->OAuthToken);


    }

    public function getPersonalFeed()
    {

        $feed = $this->instagram->getUserFeed(35);
        return $this->encodeJSON($feed);

    }


    public function search($tag)
    {
        $response = $this->instagram->getTagMedia($tag, 33);
        return $this->encodeJSON($response);

    }

    public function getPublicFeed()
    {
        $popularmedia = $this->instagram->getPopularMedia();
        return $this->encodeJSON($popularmedia);

    }

    public function encodeJSON($json)
    {

        $feed;
        $i = 0;

        foreach ($json->data as $media) {

            $data;
            $data['type'] = $media->type;
            $data['tags'] = $media->tags;
            $data['createdTime'] = $this->formatTime($media->created_time);
            if (isset($media->caption, $media->caption->text)) {
                $data['text'] = $media->caption->text;
            } else {
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
            $feed[$i] = $data;
            $i++;
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

        $timeJSON=array('day'=>substr($formattedTime, 0,2),
                        'month'=>substr($formattedTime, 3,2),
                        'year'=>substr($formattedTime, 5,5),
                        'hour'=>substr($formattedTime, 11,2),
                        'minute'=>substr($formattedTime, 14,2),
                        'second'=>substr($formattedTime, 17)
                        );

        return json_encode($timeJSON);
    }
}

?>