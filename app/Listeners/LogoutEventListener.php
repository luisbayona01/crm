<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Event;
use App\Events\WebSocketMessageEvent;

class LogoutEventListener
{
    public function handle(Logout $event)
    {
        // Acciones de cierre de sesión...
  //dd($event);
        // Disparar el evento WebSocketMessageEvent
        Event::dispatch(new WebSocketMessageEvent($event->user->id, 'Logout due to inactivity'));
    }
}
