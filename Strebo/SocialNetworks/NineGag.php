<?php
namespace Strebo\SocialNetworks;

use Strebo;

class NineGag extends Strebo\AbstractSocialNetwork implements Strebo\PublicInterface
{

    public function __construct()
    {
        parent::__construct(
            '9GAG',
            'GAG_new_logo',
            '#000000',
            ["DE" => null, "US" => null, "W" => null],
            null,
            null,
            null
        );
    }

    public function search($tag)
    {
       return null;
    }

    public function getPublicFeed($location)
    {
        return $this->encodeJSON(file_get_contents('http://infinigag.k3min.eu/trending'));
    }

    public function encodeJSON($json)
    {

        $data = json_decode($json, true);
        $feed = [];

        foreach ($data["data"] as $gitem) {
            $item = [];
            $item["title"] = $gitem["caption"];
            $item["author"] = "9GAG";
            $item["numberOfLikes"] = $gitem["votes"]["count"];
            $item["link"] = $gitem["link"];
            if($gitem["media"] != false) {
                $item["type"] = "video";
                $item["media"] = $gitem["media"]["webm"];
            } else {
                $item["type"] = "image";
                $item["media"] = $gitem["images"]["large"];
            }
            $item["createdTime"] = "";
            $item["thumb"] = $gitem["images"]["small"];
            $feed[] = $item;
        }

        $newJSON = array('name' => parent::getName(),
            'icon' => parent::getIcon(),
            'color' => parent::getColor(),
            'customIcon' => true,
            'feed' => $feed);

        return json_encode($newJSON);
    }
}
