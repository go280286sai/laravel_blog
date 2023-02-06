<?php

namespace App\Events;

use GuzzleHttp\Client;
use Http\Discovery\Exception;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Pusher\Pusher;

class UserSend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected int $id;

    public function __construct($message, $id)
    {

        $this->id = $id;
        $custom_client = new Client();
        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => false,
        ];
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options,
            $custom_client
        );
        try {
            $pusher->trigger('user.'.$id, 'user-event', $message);
        }
       catch (\Exception $e){
           Log::error('UserSend Error: '.$message.' '.$id);
       }
    }

    /**
     * @return PrivateChannel
     */
    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('user.'.$this->id);
    }

    /**
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'user-event';
    }
}
