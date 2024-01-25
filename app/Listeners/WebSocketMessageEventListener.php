<?php

use App\WebSocket\WebSocketWs;

class WebSocketMessageEventListener implements ShouldQueue
{
    protected $webSocket;

    public function __construct(WebSocketWs $webSocket)
    {
        $this->webSocket = $webSocket;
    }

    public function handle(WebSocketMessageEvent $event)
    {
        $messageType = $event->messageType;

        switch ($messageType) {
            case 'Logout due to inactivity':
                $userId = $event->userId;
                $connection = $event->connection; // Esto debe ser la conexión WebSocket

                // Llamar al método closeConexion desde la clase WebSocketWs
                $this->webSocket->closeConexion($userId, $connection);
                break;
            // Otros casos...
        }
    }
}
