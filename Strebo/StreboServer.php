<?php
namespace Strebo;

use Strebo;

class StreboServer extends WebSocketServer
{

    protected $users;
    private $dataCollector;


    function __construct($ip, $port)
    {
        parent::__construct($ip, $port);
        //timezone here
        $this->dataCollector = new Strebo\DataCollector();
    }

    protected function process($user, $message)
    {
        if ($this->isJson($message)) {
            $data = json_decode($message);
            $socialData = null;

            switch ($data->command) {
                case 'getPublicFeed':
                    while ($socialData == null) {
                        $socialData = $this->dataCollector->getPublicFeed($data->param);
                    }
                    $this->send($user, $socialData);
                    break;

                case 'search':
                    while ($socialData == null) {
                        $socialData = $this->dataCollector->search($data->param);
                    }
                    $this->send($user, $socialData);
                    break;

                case 'getPersonalFeed':
                    while ($socialData == null) {

                    }
                    break;
            }

        } else {

            $this->send($user, json_encode(["type" => "message", "message" => "Hi! Here is Server. I got something from you: " . $message]));

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
        $this->users[] = $user;
        $this->send($user, json_encode(["type" => "message", "message" => "Happy Welcome!"]));
    }

    protected function closed($user)
    {
        unset($this->users[array_keys($this->users, $user)]);
    }
}

?>