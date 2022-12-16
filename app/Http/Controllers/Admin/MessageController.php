<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\MailingJob;
use App\Mail\answer_email;
use App\Models\Message;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $mails = Message::all()->sortBy('status');

        return view('admin.messages.index', ['mails' => $mails, 'i' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return void
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show(int $id): View
    {
        $message = Message::find($id);

        return view('admin.messages.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit(int $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $message = Message::find($id);
        $message->status = 1;
        $message->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Message::where('id', $id)->delete();

        return back();
    }

    /**
     * @param  Request  $request
     * @return View
     */
    public function getAnswer(Request $request): View
    {
        $name = $request->get('name');
        $title = $request->get('title');
        $email = $request->get('email');
        $content = $request->get('content');

        return view('admin.messages.answer', ['name' => $name, 'title' => $title, 'email' => $email, 'content' => $content]);
    }

    /**
     * @param  Request  $request
     * @return Redirector|Application|RedirectResponse
     */
    public function setAnswer(Request $request): Application|RedirectResponse|Redirector
    {
        Mail::to($request->email)->cc(Auth::user()->email)->send(new answer_email($request->all()));

        return redirect('/admin/messages');
    }

    /**
     * @return View
     */
    public function mailing_list(): View
    {
        return view('admin.messages.mailing_list');
    }

    /**
     * @param  Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function sendMailing(Request $request): Redirector|RedirectResponse|Application
    {
        $content = $request->get('content');
        $title = $request->get('title');
        $mailing = $request->get('mailing');
        $from = Auth::user()->email;
        if ($mailing == 'for_users') {
            $mails = User::pluck('email')->all();
        } elseif ($mailing == 'for_subscription') {
            $mails = Subscription::pluck('email')->all();
        } else {
            $users = User::pluck('email')->all();
            $subscription = Subscription::pluck('email')->all();
            $mails = array_merge($users, $subscription);
        }
        MailingJob::dispatch($mails, $title, $content, $from)->onQueue('mailing');

        return redirect('/admin/messages');
    }
}
