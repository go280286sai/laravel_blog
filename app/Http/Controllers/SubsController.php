<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Mail\SubscribeEmail;
use App\Models\Subscription;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SubsController extends Controller
{
    /**
     * @param  SubscribeRequest  $request
     * @return RedirectResponse
     */
    public function subscribe(SubscribeRequest $request): RedirectResponse
    {
        $subs = Subscription::add($request->get('email'));
        Mail::to($subs->email)->send(new SubscribeEmail($subs->token));
        Log::info('Add subscribe');

        return redirect()->back()->with('status', __('messages.check_your_mail'));
    }

    /**
     * @param $token
     * @return RedirectResponse
     */
    public function verify($token): RedirectResponse
    {
        $subs = Subscription::all()->where('token', $token)->firstOrFail();
        $subs->token = null;
        $subs->unset = Str::random(40);
        $subs->save();
        Log::info('Full subscribe');

        return redirect('/')->with('status', __('messages.your_email_has_been_verified'));
    }

    /**
     * @param $id
     * @return View
     */
    public function unsetEmail($id): View
    {
        return view('pages.unsubscribe', ['id' => e($id)]);
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function unsets(Request $request): RedirectResponse
    {
        if (Subscription::unscriber($request->get('email'))) {
            Log::info('Unscriber email');

            return redirect('/')->with('status', __('messages.successfully_unsubscribed'));
        }
        Log::info('Error unscriber email');

        return redirect('/')->with('status', __('messages.you_are_not_subscribed'));
    }
}
