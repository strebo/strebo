#!/usr/bin/env php
<?php

require './server.php';
require './DataCollector.php';

class StreboServer extends WebSocketServer
{

    protected $users;
    private $dataCollector;


    function __construct($ip, $port)
    {
        parent::__construct($ip, $port);
        $this->dataCollector = new Strebo\DataCollector();
    }

    protected function process($user, $message)
    {
        echo(var_dump($message));
        if ($this->isJson($message)) {
            $data=json_decode($message);
            echo(var_dump($data));
            $function = "\$this->dataCollector->" . $data->command;

            switch ($data->command){
                case 'getPublicFeed':
                    $this->send($user,$this->dataCollector->getPublicFeed($data->param));
                    echo(var_dump($this->dataCollector->getPublicFeed($data->param)));
                    break;
            }

        } else {

            $this->send($user, json_encode(["type"=>"message", "message"=>"Hi! Here is Server. I got something from you: " . $message]));

            foreach ($this->users as $client) {
                if ($user != $client) {
                    $this->send($client, $message);
                }
            }

        }


    }

    protected function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }


    protected function connected($user)
    {
        for ($j = 0; $j <= count($this->users); $j++) {
            if (!isset($this->users[$j])) {
                $this->users[$j] = $user;
                $this->send($user, json_encode(["type"=>"message","message"=>"Happy Welcome!"]));
                break;
            }
        }

    }

    protected function closed($user)
    {
        for ($i = 0; $i < count($this->users); $i++) {
            if ($user == $this->users[$i]) {
                unset($this->users[$i]);
                break;
            }
        }
    }
}

putenv('strebo_instagram_1=c12bbe37871f443ca257ef54a131a777');
putenv('strebo_twitter_1=3872089625-xRvrn2Qb8QG5GDtrskVFy1E1wQAgQPpX5xsFKZa');
putenv('strebo_twitter_2=rnGWYxMdQJmj4Q5YdddNC2EUPhKffSvcj3WhBzOjSiO8a');
putenv('strebo_twitter_3=BspGfBzzXbBKtdWpl0eL1cihi');
putenv('strebo_twitter_4=I3ht3hDmG0vY2uTb32WaupyKQq7Rv0htaGW8x2DDhd5ExrNij9');
putenv('strebo_soundcloud_1=b44373de55ef0a0048ff5de51c143db6');
putenv('strebo_soundcloud_2=9b305fb370cf50d4a8d63d745c894d44');

$strebo = new StreboServer("0.0.0.0", "8080");

try {
    $strebo->run();
} catch (Exception $e) {
    $strebo->stdout($e->getMessage());
}

?>