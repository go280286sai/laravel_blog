<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;

class MessageController extends Controller
{
    public function create(MessageRequest $request)
    {
        Message::addMessage($request->all());

        return view('message')->with('info', 'You message send');
    }

    public function show()
    {
        return view('message', ['title' => 'Contact info']);
    }
}
