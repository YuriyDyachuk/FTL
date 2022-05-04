<?php


namespace App\Models\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * @inheritDoc
     */
    public function broadcastOn()
    {
        return ['ftl_chat'];
    }

    public function broadcastAs()
    {
        return 'ftl_chat';
    }
}
