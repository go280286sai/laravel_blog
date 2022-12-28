<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Telegram;
use DefStudio\Telegraph\Models\TelegraphBot;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TelegramController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $result = Telegram::all()->sortByDesc('send_date');

        return view('admin.telegram.index', ['result' => $result, 'i' => 1]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.telegram.create');
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->get('content')) {
            $content = str_replace(['<p>', '</p>'], '', $request->get('content'));
        } else {
            $content = '';
        }
        if ($request->get('title')) {
            $title = $request->get('title');
            $text = "<b>$title</b>\n $content";
            Chat::sendMessage($text);
            Log::info('Send telegram message: '.$title.' - '.$text);
        }
        if ($request->file('photo')) {
            Chat::sendPhoto($request->file('photo'));
            Log::info('Send telegram photo');
        }
        if ($request->file('doc')) {
            Chat::sendDocument($request->file('doc'));
            Log::info('Send telegram document');
        }

        return redirect()->route('telegram');
    }

    /**
     * @param  int  $id
     * @return RedirectResponse
     */
    public function remove(int $id): RedirectResponse
    {
        Telegram::remove($id);
        Log::info('Delete telegram id: '.$id);

        return back();
    }

    /**
     * @param  Request  $request
     * @return View
     */
    public function answer(Request $request): View
    {
        $id = $request->get('id');
        $chat_id = $request->get('chat_id');
        $message_id = $request->get('message_id');

        return view('admin.telegram.answer', ['id' => $id, 'chat_id' => $chat_id, 'message_id' => $message_id]);
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     *
     * @throws GuzzleException
     */
    public function sendAnswer(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $website = 'bot'.TelegraphBot::fromId()->token;
        $chat_id = $request->get('chat_id');
        $message_id = $request->get('message_id');
        if ($request->get('content')) {
            $content = str_replace(['<p>', '</p>'], '', $request->get('content'))."\n".env('APP_URL');
        } else {
            $content = env('APP_URL');
        }
        $send = new Client();
        $send->get('https://api.telegram.org/'.$website.'/sendMessage?chat_id='.$chat_id."&text=$content&reply_to_message_id=$message_id");
        Telegram::setAnswer($id, $content);
        Log::info('Answer telegram id: '.$id.' '.$chat_id.' '.$content);

        return redirect()->route('telegram');
    }

    /**
     * @return RedirectResponse
     */
    public function update(): RedirectResponse
    {
        Telegram::add(Chat::getMessages());
        Log::info('Update telegram messages');

        return redirect()->route('telegram');
    }
}
