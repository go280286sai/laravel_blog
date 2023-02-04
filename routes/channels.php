<?php

use App\Broadcasting\ChatChennel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat', ChatChennel::class);

Broadcast::channel('user.{id}', function ($id) {
    return Auth::id() == $id;
});
