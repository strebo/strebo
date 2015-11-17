<?php
namespace Strebo\SocialNetworks;
use Strebo;
require 'SoundCloud.php';

$i=new SoundCloud();

echo ($i->getPublicFeed());
?>