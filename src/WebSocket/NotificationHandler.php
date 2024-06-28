<?php

namespace App\WebSocket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class NotificationHandler implements MessageComponentInterface
{
    protected $connections;

    public function __construct()
    {
        // print_r('NotificationHandler instance created');
        $this->connections = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        try {
            $this->connections->attach($conn);
            echo "New connection! ({$conn->resourceId})\n";
            $this->outputConnections();
        } catch (\Exception $e) {
            echo "Exception in onOpen: " . $e->getMessage() . "\n";
        }
    }

    private function outputConnections()
    {
        $connections = [];
        foreach ($this->connections as $connection) {
            $connections[] = $connection->resourceId;
        }
        // echo "Current connections: " . implode(', ', $connections) . "\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->connections as $connection) {
            if ($from !== $connection) {
                $connection->send($msg);
                // $connection->send(json_encode(['message' => 'Hello from the server!']));
            }
        }
        
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->connections->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function getConnections()
    {
        $connections = [];
        foreach ($this->connections as $connection) {
            $connections[] = $connection->resourceId;
        }

        return $connections;
    }
}
