<?php

namespace App\Events;

use GuzzleHttp\Client;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Pusher\Pusher;

class MessageSend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct($message)
    {
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
        $pusher->trigger('chat', 'my-event', $message);
    }


    /**
     * @return PrivateChannel
     */
    public function broadcastOn(): PrivateChannel
    {

      return  new PrivateChannel('chat');
    }

    /**
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'my-event';
    }

}
