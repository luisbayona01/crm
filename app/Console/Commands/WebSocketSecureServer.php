<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\Socket\SecureServer;
use React\Socket\Server;
use App\Http\Controllers\SocketController;

class WebSocketSecureServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocketsecure:init {--port=8080 : The port to run the WebSocket server}';

    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $port = $this->option('port');

        $loop = Factory::create();
        $webSocketServer = new WsServer(new SocketController());

        $socket = new Server('0.0.0.0:' . $port, $loop);
        $secureSocket = new SecureServer($socket, $loop, [
            'local_cert' => base_path('ssl/tu-certificado.crt'),
        'local_pk' => base_path('ssl/tu-llave-privada.key'),
            'verify_peer' => true,
        ]);

        $server = new IoServer(
            new HttpServer(
                $webSocketServer
            ),
            $secureSocket,
            $loop
        );

        $this->info("WebSocket server running on port $port");

        $server->run();
    }
}
