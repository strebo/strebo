<?php

namespace Strebo\SocialNetworks;

use Strebo;

class Facebook extends Strebo\AbstractSocialNetwork implements Strebo\PrivateInterface
{
    private $facebook;
    private $token;

    public function __construct()
    {
        parent::__construct(
            "Facebook",
            "facebook",
            "#3b5999",
            [null, null, null],
            getenv("strebo_facebook_1"),
            getenv("strebo_facebook_2"),
            "http://strebo.net/?Facebook=1"
        );

        $this->facebook = new \Facebook\Facebook(
            ['app_id' => $this->getApiKey(),
                'app_secret' => $this->getApiSecret(),
                'default_graph_version' => 'v2.6']
        );
    }

    public function connect($code)
    {
        try {
            $client = $this->facebook->getOAuth2Client();
            $token = $client->getAccessTokenFromCode($code[0], $this->getApiCallback());
            $longTermToken = $client->getLongLivedAccessToken($token);
            return [$longTermToken, null];
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return null;
        }
    }

    public function getPersonalFeed($user)
    {
        $token = $user->getAuthorizedToken($this->getName());
        $this->token = $token;
        $feeds = [];
        $taggedPosts = $this->facebook->get(
            '/me/tagged?limit=10&fields=message,likes,link,description,caption,created_time,from,picture,source&',
            $token
        );
        $likes = $this->facebook->get("/me/likes?limit=10", $token);
        $likePosts = [];
        $body = $likes->getDecodedBody();
        foreach ($body["data"] as $site) {
            $likePosts[] = $this->facebook->get(
                $site["id"] .
                "/posts?limit=5&fields=message,likes,link,description,caption,created_time,from,picture,source",
                $token
            );
        }
        $decodedBody = $taggedPosts->getDecodedBody();
        if (!empty($decodedBody["data"])) {
            $feeds[] = $this->encodeJSON($decodedBody);
        }

        foreach ($likePosts as $site) {
            $decodedBody = $site->getDecodedBody();
            if (!empty($decodedBody["data"])) {
                $feeds[] = $this->encodeJSON($site->getDecodedBody());
            }
        }

        if (empty($feeds)) {
            return null;
        }
        if (!empty($feeds)) {
            $feed = [];
            foreach ($feeds as $array) {
                $feed = array_merge($feed, $array);
            }

            $this->token = null;
            return json_encode(
                ['name' => parent::getName(),
                    'icon' => parent::getIcon(),
                    'color' => parent::getColor(),
                    'feed' => $feed]
            );
        }

    }

    public function encodeJSON($json)
    {
        $feed = [];

        foreach ($json["data"] as $item) {

            $data = [];

            $data['tags'] = null;
            $data['createdTime'] = parent::formatTime(strtotime($item["created_time"]));

            if (isset($item["source"])) {
                $data['type'] = "video";
                $data['media'] = $item["source"];
                $data['thumb'] = $item["picture"];
            }

            if (!isset($item["source"]) && isset($item["picture"])) {
                $data['type'] = "image";
                $data['media'] = $item["picture"];
                $data['thumb'] = $item["picture"];
            }
            if (!isset($item["picture"]) && !isset($item["source"])) {
                $data['type'] = "text";
                $data['media'] = null;
                $data['thumb'] = null;
            }

            $data['link'] = $item["link"];
            $data['author'] = $item["from"]["name"];

            $author = $this->facebook->get($item["from"]["id"] . "?fields=picture", $this->token);
            $body = $author->getDecodedBody();
            $data['authorPicture'] = $body["picture"]["data"]["url"];

            $likes = $this->facebook->get($item["id"] . "/likes?summary=true", $this->token)->getDecodedBody();
            $data['numberOfLikes'] = $likes["summary"]["total_count"];
            $data['title'] = null;
            $data['text'] = null;
            if (isset($item["message"])) {
                $data['text'] = $item["message"];
            }
            $feed[] = $data;
        }
        return $feed;
    }

    public function isTokenValid($user)
    {
        $expiringDate = $user->getAuthorizedToken($this->getName());
        if ($expiringDate != null) {
            $expiringDate = $expiringDate->getExpiresAt();
            $now = new \DateTime(date("Y-m-d H:i:s.u"));
            if ($now->diff($expiringDate)->format('%R') == "-") {
                $user->removeAuthorizedToken($this->getName());
                $user->removeClient($this->getName());
            }
        }
    }
}
