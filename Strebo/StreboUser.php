<?php

namespace Strebo;

class StreboUser extends \Thread
{
    private $userId;
    private $socketId;
    private $tokens;
    private $authorizedTokens;
    private $clients;
    private $privateFeed;
    private $timer;

    public function __construct($userId, $socketId)
    {
        $this->userId = $userId;
        $this->socketId = $socketId;
        $this->tokens = [];
        $this->clients = [];
        $this->authorizedTokens = [];
        $this->privateFeed = [];
        $this->timer = 0;
        $this->start();
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getSocketId()
    {
        return $this->socketId;
    }

    public function setSocketId($socketId)
    {
        $this->socketId = $socketId;
    }

    public function addToken($network, $token)
    {
        $this->tokens[$network] = $token;
    }

    public function getTokens()
    {
        return $this->tokens;
    }

    public function addClient($network, $client)
    {
        $this->clients[$network] = $client;
    }

    public function getClient($network)
    {
        if (isset($this->clients[$network])) {
            return $this->clients[$network];
        }
        if (!isset($this->clients[$network])) {
            return null;
        }
    }

    public function getClients()
    {
        return $this->clients;
    }

    public function getAuthorizedToken($network)
    {
        return $this->authorizedTokens[$network];
    }

    public function addAuthorizedToken($network, $authorizedToken)
    {
        $this->authorizedTokens[$network] = $authorizedToken;
    }

    public function getToken($network)
    {
        if (isset($this->tokens[$network])) {
            return $this->tokens[$network];
        }
        if (!isset($this->tokens[$network])) {
            return null;
        }
    }

    public function getPrivateFeed()
    {
        return $this->privateFeed;
    }

    public function addPrivateFeed($network, $feed)
    {
        $this->privateFeed[$network] = $feed;
    }

    public function run()
    {
        while (true) {
            if (isset($this->privateFeed) && $this->timer == 240) {
                $this->privateFeed = (array)[];
                $this->timer = 0;
            }
            sleep(1);
        }
    }

    public function setTimer($timer)
    {
        $this->timer = $timer;
    }

    public function removeToken($network)
    {
        unset($this->tokens[$network]);
    }

    public function removeClient($network)
    {
        unset($this->clients[$network]);
    }
}
