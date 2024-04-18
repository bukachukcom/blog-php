<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    private array $connected = [];

    public function __construct()
    {
    }

    public function onOpen(ConnectionInterface $conn)
    {
        var_dump('onOpen');
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        //var_dump($data);
        if (!empty($data['initial']) && !empty($data['email'])) {
            $this->connected[$data['email']][] = $from;
            echo 'Connect user ' . $data['email'] . PHP_EOL;
        } elseif ($data) {
            foreach ($this->connected[$data['email']] as $connection) {
                $connection->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        var_dump('onClose');
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo 'Error: ' . $e->getMessage() . PHP_EOL;
    }
}
