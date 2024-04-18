<?php
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;

require 'vendor/autoload.php';
require_once 'Chat.php';

$server = IoServer::factory(
    new HttpServer(new WsServer(new Chat())),
    8081
);

$server->run();
