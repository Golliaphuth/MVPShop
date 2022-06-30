<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CartEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $count;

    public function __construct($count)
    {
        $this->count = $count;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('public.cart');
    }

    public function broadcastAs(): string
    {
        return 'cart';
    }

    public function broadcastWith(): array
    {
        return [
            'count' => $this->count
        ];
    }
}
