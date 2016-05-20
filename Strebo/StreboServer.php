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

                case 'getPrivateFeed':
                    $currentUser = $this->getStreboUser($user);
                    $this->send($user, $this->dataCollector->collectPersonalFeed($currentUser));
                    break;

                case 'connect':
                    $streboUser = $this->getStreboUser($user);
                    $streboUser->addToken($data->network, $data->tokens);
                    $this->send($user, $this->dataCollector->getNetworksPrivate($streboUser));
                    $this->dataCollector->connect($streboUser, $data->network);
                    break;

                case 'getNetworks':
                    $streboUser = $this->getStreboUser($user);
                    $this->send($user, $this->dataCollector->getNetworksPrivate($streboUser));
                    break;

                case 'identify':
                    $streboUser = $this->handleNewSocketConnection($data->id, $user);
                    $this->send($user, $this->dataCollector->getNetworksPrivate($streboUser));
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

    public function getStreboUser($user)
    {
        foreach ($this->streboUsers as $streboUser) {
            if ($user instanceof WebSocketUser) {
                if ($streboUser->getSocketId() == $user->id) {
                    return $streboUser;
                }

            }
            if (!$user instanceof WebSocketUser) {
                if ($streboUser->getUserId() == $user) {
                    return $streboUser;
                }
            }
        }
    }

    public function streboUserIsExisting($userId)
    {
        foreach ($this->streboUsers as $streboUser) {
            if ($streboUser->getUserId() == $userId) {
                return true;
            }
        }
        return false;
    }

    public function handleNewSocketConnection($userId, $socketUser)
    {
        if ($this->streboUserIsExisting($userId)) {
            $currentUser = $this->getStreboUser($userId);
            $currentUser->setSocketId($socketUser->id);
            return $this->getStreboUser($socketUser);
        }
        if (!$this->streboUserIsExisting($userId)) {
            $currentUser = new StreboUser($userId, $socketUser->id);
            $this->streboUsers[] = $currentUser;
            return $currentUser;
        }

    }
}
