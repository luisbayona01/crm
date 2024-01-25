<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WebSocketMessageEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $messageType;
    public $connection;

    /**
     * Create a new event instance.
     *
     * @param  int  $userId
     * @param  string  $messageType
     * @param  ConnectionInterface  $connection
     * @return void
     */
    public function __construct($userId, $messageType, $connection)
    {
        $this->userId = $userId;
        $this->messageType = $messageType;
        $this->connection = $connection;
    }
}
