<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageSend;
use App\Events\UserSend;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageFormRequest;
use App\Models\Broadcast;
use Illuminate\Http\RedirectResponse;
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
     * @return void
     */
    public function send(MessageFormRequest $request): void
    {
        $message = [
            'message' => $request->get('message'),
            'name' => $request->get('name'),
            'date' => $request->get('date'),
            'avatar' => $request->get('avatar'),
            'user_id' => $request->get('user_id'),
        ];
        Broadcast::addChat($message);
        \broadcast(new MessageSend($message));
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function sendUser(Request $request): RedirectResponse
    {
        $message = strip_tags($request->get('message'));
        $id = $request->get('id');
        \event(new UserSend($message, $id));

        return redirect('/admin/users');
    }

    /**
     * @return string
     */
    public function getBroadcast(): string
    {
        return Broadcast::getChat()->toJson();
    }
}
