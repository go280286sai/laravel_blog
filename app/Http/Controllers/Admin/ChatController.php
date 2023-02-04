<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageSend;
use App\Events\UserSend;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageFormRequest;
use Illuminate\Http\Request;
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

    public function sendUser(Request $request)
    {
       $message =strip_tags($request->get('message'));
       $id = $request->get('id');

        \broadcast(new UserSend($message, $id));

        return redirect('/admin/users');
    }
}
