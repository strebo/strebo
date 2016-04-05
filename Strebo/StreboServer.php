#!/usr/bin/env php
<?php

require './server.php';

class StreboServer extends WebSocketServer
{

    protected $users;

    protected function process($user, $message)
    {
        $this->send($user, "Hi! Here is Server. I got something from you: " . $message);

        foreach ($this->users as $client) {
            if ($user != $client) {
                $client->send($client, $message);
            }
        }
    }

    protected function connected($user)
    {
        $this->users[] = $user;
        $this->send($user, "Happy Welcome!");


    }

    protected function closed($user)
    {
        for ($i = 0; i < count($this->users); $i++) {
            if ($user == $this->users[$i]) {
                unset($this->users[$i]);
                break;
            }
        }
    }
}

$strebo = new StreboServer("0.0.0.0", "8080");

try {
    $strebo->run();
} catch (Exception $e) {
    $strebo->stdout($e->getMessage());
}

?>