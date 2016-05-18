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

    public function __construct($id, $socket)
    {
        $this->id = $id;
        $this->socket = $socket;
        if (isset($_SESSION["tokens"])) {
            $this->tokens = $_SESSION["tokens"];
        }
    }

    public function addToken($network, $token)
    {
        $this->tokens[$network] = $token;
        $_SESSION["tokens"] = $this->tokens;
    }

    public function getTokens()
    {
        return $this->tokens;
    }
}
