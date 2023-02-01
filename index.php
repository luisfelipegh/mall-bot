<?php

require 'vendor/autoload.php';
require_once 'File.php';

$websocketUrl = '';

$client = new WebSocket\Client($websocketUrl, [
        'timeout' => 60
    ]
);

$client->text(json_encode([
    'event' => 'pusher:subscribe',
    'data' => [
        'channel' => 'bot'
    ]
]));

while (true) {
    try {
        $message = json_decode($client->receive());

        echo $message;

    } catch (WebSocket\TimeoutException $exception) {

    }
}

$client->close();
