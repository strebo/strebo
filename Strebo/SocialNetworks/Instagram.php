<?php
namespace Strebo\SocialNetworks;
use Strebo;

require __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/../../Autoloader.php';
spl_autoload_register (array ('Autoloader', 'autoload'));

use MetzWeb\Instagram\Instagram as InstagramAPI;

class Instagram extends Strebo\AbstractSocialNetwork implements Strebo\PrivateInterface, Strebo\PublicInterface{
	
private $instagram;
private $apiKey;
private $apiSecret;
private $apiCallback='http://strebo.net';
private $OAuthToken;

public function __construct(){
		$this->apiKey=getenv('strebo_instagram_1');
		$this->instagram=new InstagramAPI ($this->apiKey);
		
}

public function connect($code){
	$this->apiSecret=getenv('strebo_instagram_2');
	$this->instagram=new InstagramAPI(array( 'apiKey' => $this->apiKey, 'apiSecret'=> $this->apiSecret, 'apiCallback'=>$this->apiCallback));
	$this->OAuthToken=$this->instagram->getOAuthToken($code);
	echo($code);
	echo "<br/>";
	var_dump($this->OAuthToken);
	$this->instagram->setAccessToken($this->OAuthToken);

	
}

public function getPersonalFeed(){
	
	$feed=$this->instagram->getUserFeed(35);
	return $feed;
	
}


public function search($tag) {
	$response = $this->instagram->getTagMedia($tag,33);
	$this->getMedia($response);
	return $response;
	
}

public function getPublicFeed() {
	$popularmedia = $this->instagram->getPopularMedia ();
	$this->getMedia($popularmedia);
	return $popularmedia;
	
}

//Nur für Testzwecke
public function getMedia($media){
	foreach ( $media->data as $entry ) {
	
		echo "<p>{$entry->caption->from->username}<br/>";
	
		if ($entry->type === 'image') {
				
			echo "<img src=\"{$entry->images->thumbnail->url}\"><br/>";
		}
	
		if ($entry->type === 'video') {
			echo "<video width=\"320\" height=\"240\" controls src=\"{$entry->videos->standard_resolution->url}\"><br/>";
		}
		echo "likes: {$entry->likes->count}<br/>";
	
		$tags = $entry->tags;
		$i = 0;
		while ( $i < count ( $tags ) ) {
			echo "#{$tags[$i]} ";
			$i ++;
		}
	}
}


}

?>