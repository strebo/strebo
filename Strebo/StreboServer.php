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
            $data=json_decode($message);
            $function = "\$this->dataCollector->" . $data->command;

            switch ($data->command){
                case 'getPublicFeed':
                    $this->send($user,$this->dataCollector->getPublicFeed($data->param));
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
?>