<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\Customerpanel\Models\Chat;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->chat->receiver_id);
    }

    public function broadcastAs()
    {
        return 'NewMessageSent';
    }

    public function broadcastWith()
    {
        // Log::info('📤 Broadcasting message event', [
        //     'to' => 'chat.' . $this->chat->receiver_id,
        //     'message' => $this->chat->message,
        // ]);

        return [
            'message' => $this->chat->message,
            'sender_id' => $this->chat->sender_id,
            'receiver_id' => $this->chat->receiver_id,
            'created_at' => $this->chat->created_at->toDateTimeString(),
            'sender_name' => $this->chat->sender->first_name . ' ' . $this->chat->sender->last_name,
        ];
    }
}
