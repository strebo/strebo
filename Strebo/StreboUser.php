<?php

namespace Strebo;

class StreboUser
{
    private $userId;
    private $socketId;
    private $tokens;

    public function __construct($userId, $socketId)
    {
        $this->$userId = $userId;
        $this->socketId = $socketId;
        $this->tokens = [];
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
}
