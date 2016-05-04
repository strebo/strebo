<?php
namespace Strebo;
class WebSocketUser
{
    public $socket;
    public $id;
    public $headers = array();
    public $handshake = false;
    public $handlingPartialPacket = false;
    public $partialBuffer = "";
    public $sendingContinuous = false;
    public $partialMessage = "";
    public $hasSentClose = false;

    private $tokens = [];

    function __construct($id, $socket)
    {
        $this->id = $id;
        $this->socket = $socket;
    }

    function addToken($network, $token)
    {
        $this->tokens[$network] = $token;
    }

    function getTokens()
    {
        return $this->tokens;
    }
}
