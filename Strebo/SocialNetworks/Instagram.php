<?php
namespace Strebo\SocialNetworks;
use Strebo;

require __DIR__.'/../AbstractSocialNetwork.php';

use MetzWeb\Instagram\Instagram as InstagramAPI;

class Instagram extends Strebo\AbstractSocialNetwork implements Strebo\PrivateInterface, Strebo\PublicInterface{

private $OAuthToken;
private $instagram;

public function __construct(){
		parent::__construct('Instagram','instagram');
		$this->apiKey=getenv('strebo_instagram_1');
		$this->instagram=new InstagramAPI ($this->apiKey);
		
}

public function connect($code){
	$this->apiSecret=getenv('strebo_instagram_2');
	$this->apiCallback='http://strebo.net';
	$this->instagram=new InstagramAPI(array( 'apiKey' => $this->apiKey, 'apiSecret'=> $this->apiSecret, 'apiCallback'=>$this->apiCallback));
	$this->OAuthToken=$this->instagram->getOAuthToken($code);
	$this->instagram->setAccessToken($this->OAuthToken);

	
}

public function getPersonalFeed(){
	
	$feed=$this->instagram->getUserFeed(35);
	return $this->encodeJSON($feed);
	
}


public function search($tag) {
	$response = $this->instagram->getTagMedia($tag,33);
	//$this->getMedia($response);
	return $this->encodeJSON($response);
	
}

public function getPublicFeed() {
	$popularmedia = $this->instagram->getPopularMedia ();
	//$this->getMedia($popularmedia);
	return $this->encodeJSON($popularmedia);
	
}

public function encodeJSON($json){

	$feed;
	$i=0;

	foreach($json->data as $media){

		$data;
		$data['mediatype']=$media->type;
		$data['tags']=$media->tags;
		$data['created_time']=$media->created_time;
		if(array_key_exists('caption', $media) && array_key_exists('text', $media->caption)){
		$data['text']=$media->caption->text;
		}
		$data['from']=$media->user->username;
		$data['from_picture']=$media->user->profile_picture;
		$data['number_of_likes']=$media->likes->count;
		if($media->type==='image'){
			$data['media']=$media->images->standard_resolution->url;
		}
		if($media->type==='video'){
			$data['media']=$media->videos->standard_resolution->url;
		}
		$feed[$i]=$data;
		$i++;
	}

	$newJSON=array('name'=>'Instagram',
				'icon'=>'instagram',
				'color'=>'#2a5b83',
				'feed'=>$feed);

	return json_encode($newJSON);
}

//Nur für Testzwecke
/*public function getMedia($media){
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
*/

}

?>