<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Http\Controllers\SocketController;

require dirname(__FILE__) . '/vendor/autoload.php';

$loop   = React\EventLoop\Factory::create();
$webSock = new React\Socket\SecureServer(
	new React\Socket\Server('0.0.0.0:8080', $loop),
	$loop,
	array(
        'local_cert' => base_path('ssl/tu-certificado.crt'),
        'local_pk' => base_path('ssl/tu-llave-privada.key'),
        'allow_self_signed' => FALSE, // Allow self signed certs (should be false in production)
        'verify_peer' => FALSE
	)
);

// Ratchet magic
$webServer = new Ratchet\Server\IoServer(
	new Ratchet\Http\HttpServer(
		new Ratchet\WebSocket\WsServer(
            new SocketController()
		)
	),
	$webSock
);

$loop->run();
