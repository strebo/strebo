<?php

namespace Strebo;

class StreboUser
{
    private $userId;
    private $socketId;
    private $tokens;
    private $authorizedTokens;
    private $clients;

    public function __construct($userId, $socketId)
    {
        $this->userId = $userId;
        $this->socketId = $socketId;
        $this->tokens = [];
        $this->clients = [];
        $this->authorizedTokens = [];
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
        return $this->clients[$network];
    }

    public function getAuthorizedToken($network)
    {
        return $this->authorizedTokens[$network];
    }

    public function setAuthorizedToken($network, $authorizedToken)
    {
        $this->authorizedTokens[$network] = $authorizedToken;
    }
}
