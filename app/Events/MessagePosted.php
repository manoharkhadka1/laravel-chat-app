<?php

namespace App\Events;
use Illuminate\Support\Facades\Log;

use App\Message;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessagePosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;
    public $r_user_id; // receiver userId
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message,User $user,$r_user_id)
    {
        $this->message = $message;
        $this->user = $user;
        $this->r_user_id = $r_user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        Log::error(print_r($this->user->id.$this->r_user_id,true));
        return new PrivateChannel('chatroom.'.$this->user->id.$this->r_user_id);
    }
}
