<?php
// src/Service/WebSocketConnectorFactory.php

namespace App\Service;

class WebSocketConnectorFactory
{
    public static function create(string $sharedFilePath)
    {
        return new \App\WebSocket\NotificationHandler($sharedFilePath);
    }
}
