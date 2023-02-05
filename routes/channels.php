<?php

use App\Broadcasting\ChatChannel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat', ChatChannel::class);

Broadcast::channel('user.{id}', function ($id) {
    return Auth::id() == $id;
});
