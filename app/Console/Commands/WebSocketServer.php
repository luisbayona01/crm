<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use App\Http\Controllers\SocketController;

class WebSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
  protected $signature = 'websocket:init {--port=8080 : The port to run the WebSocket server}';

    protected $description = 'Initialize the WebSocket server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $port = $this->option('port');

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SocketController()
                )
            ),
            $port
        );

        $this->info("WebSocket server running on port $port");

        $server->run();
    }
}
