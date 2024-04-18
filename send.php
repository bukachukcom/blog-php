<?php
require 'vendor/autoload.php';

$client = new WebSocket\Client("ws://localhost:8081");
$client->text("user@yandex.ru:new-comment");
$client->close();
