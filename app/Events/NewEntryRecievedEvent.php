<?php

namespace App\Events;

use App\Models\ContestEntry;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewEntryRecievedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $ContestEntry;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ContestEntry $contestEntry)
    {
        $this->ContestEntry = $contestEntry;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
