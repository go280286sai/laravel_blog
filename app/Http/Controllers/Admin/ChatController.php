<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageSend;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageFormRequest;
use Illuminate\View\View;

class ChatController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.chat');
    }

    /**
     * @param  MessageFormRequest  $request
     * @return bool
     */
    public function send(MessageFormRequest $request): bool
    {
        $message = [
            'message' => $request->get('message'),
            'name' => $request->get('name'),
            'date' => $request->get('date'),
            'avatar' => $request->get('avatar'),
        ];

        \broadcast(new MessageSend($message));

        return true;
    }
}
