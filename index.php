<?php

require 'vendor/autoload.php';
require_once 'File.php';
const CHANNEL = 'bots';
const WEB_SOCKET_URL = "ws://ws-us2.pusher.com:80/app/128b02cc77db3e123848?version=7.0.3&protocol=5";

$client = new WebSocket\Client(WEB_SOCKET_URL, [
        'timeout' => 60
    ]
);

$client->text(json_encode([
    'event' => 'pusher:subscribe',
    'data' => [
        'channel' => CHANNEL
    ]
]));

while (true) {
    try {
        $payload = json_decode($client->receive());
        $event = $payload->event ?? null;
        $data = json_decode($payload?->data);

        dump('nuevo evento "' . $event . '" recibido: ' . json_encode($data));

    } catch (WebSocket\TimeoutException $exception) {

    }
}

File::saveClientDelivery([]);

$client->close();
