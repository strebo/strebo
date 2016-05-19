<?php
namespace Strebo;

use Strebo;

class StreboServer extends WebSocketServer
{
    private $dataCollector;
    private $streboUsers;


    public function __construct($ipAddress, $port)
    {
        parent::__construct($ipAddress, $port);
        date_default_timezone_set('Europe/Berlin');
        $this->dataCollector = new Strebo\DataCollector();
        $this->streboUsers = [];
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
                    $this->send($user, $this->dataCollector->search($data->query));
                    break;

                case 'getPersonalFeed':
                    $this->send($user, $this->dataCollector->collectPersonalFeed($user->getTokens));
                    break;

                case 'connect':
                    $user->addToken($data->network, $data->token);
                    $this->send($user, $this->dataCollector->getNetworksPrivate($user));
                    break;

                case 'getNetworks':
                    $this->send($user, $this->dataCollector->getNetworksPrivate($user));
                    break;

                case 'identify':
                    $userExisting = false;
                    foreach ($this->streboUsers as $streboUser) {
                        if ($streboUser->getId() == $data->id) {
                            $userExisting = true;
                            $streboUser->setSocketId($user->id);
                            $this->send($user, $this->dataCollector->getNetworksPrivate($streboUser));
                            break;
                        }
                    }
                    if (!$userExisting) {
                        $newUser = new StreboUser($data->id, $user->id);
                        $this->streboUsers[] = $newUser;
                        $this->send($user, $this->dataCollector->getNetworksPrivate($streboUser));
                    }
                    break;

                default:
                    $this->send($user, json_encode(["type" => "error",
                        "message" => "Not defined"]));
            }

        }
        if (!$this->isJson($message)) {

            $this->send($user, json_encode(["type" => "message",
                "message" => "Hi! Here is Server. I got something from you: " . $message]));

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
        $this->send($user, json_encode(["type" => "message", "message" => "Happy Welcome!"]));
    }

    protected function closed($user)
    {

    }
}
