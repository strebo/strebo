<?php
namespace Strebo\SocialNetworks;
use Strebo;
require 'Instagram.php';

putenv('strebo_instagram_1=c12bbe37871f443ca257ef54a131a777');

$i=new Instagram();

//header('Content-Type: application/json');
echo ($i->getPublicFeed());
?>