<?php
namespace Strebo\SocialNetworks;
use Strebo;
require 'SoundCloud.php';


$i=new SoundCloud();

$test=$i->getPublicFeed();
echo ($i->getPublicFeed());
?>