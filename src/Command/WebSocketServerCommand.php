<?php

namespace App\Command;

use React\EventLoop\Loop;
use React\Socket\TcpServer as ReactServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\WebSocket\NotificationHandler;

class WebSocketServerCommand extends Command
{
    protected static $defaultName = 'websocket:server';
    private $notificationHandler;

    public function __construct(NotificationHandler $notificationHandler)
    {
        parent::__construct();
        $this->notificationHandler = $notificationHandler;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $loop = Loop::get();
        $socket = new ReactServer('0.0.0.0:8080', $loop);
        $server = new IoServer(new HttpServer(new WsServer($this->notificationHandler)), $socket, $loop);

        $output->writeln('My WebSocket server running on port 8080.');

        // dump($server);

        $loop->run();

        return Command::SUCCESS;
    }
}
