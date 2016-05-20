<?php
namespace Strebo;

interface PrivateInterface
{
    public function connect($code);

    public function getPersonalFeed($user);
}
