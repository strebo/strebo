<?php
namespace Strebo;

use Guzzle\Http\Client;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

    class StreboServer implements MessageComponentInterface {

        protected $clients;

        public function __construct() {
            $this->clients = new \SplObjectStorage;
        }

        public function onOpen(ConnectionInterface $conn) {
            $conn->send("Happy Welcome!");
            $this->clients->attach($conn);
        }

        public function onMessage(ConnectionInterface $from, $msg) {
            $from->send("Hi! Here is Server. I got something from you: " . $msg);

            foreach ($this->clients as $client) {
                if ($from != $client) {
                    $client->send($msg);
                }
            }

        }

        public function onClose(ConnectionInterface $conn) {
            $this->clients->detach($conn);
        }

        public function onError(ConnectionInterface $conn, \Exception $e) {
            $conn->close();
        }
    }
?>