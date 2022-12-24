<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * @param MessageRequest $request
     * @return View
     */
    public function create(MessageRequest $request): View
    {
        Message::addMessage($request->all());

        return view('message')->with('info', __('messages.you_message_send'));
    }

    /**
     * @return View
     */
    public function show(): View
    {
        return view('message', ['title' => 'Contact info', 'contact'=>'active']);
    }
}
