<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeEmail;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class SubsController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscriptions',
        ]);

        $subs = Subscription::add($request->get('email'));
        Mail::to($subs->email)->send(new SubscribeEmail($subs->token));

        return redirect()->back()->with('status', 'Проверьте вашу почту!');
    }

    public function verify($token)
    {
        $subs = Subscription::all()->where('token', $token)->firstOrFail();
        $subs->token = null;
        $subs->unset = Str::random(40);
        $subs->save();

        return redirect('/')->with('status', 'Ваша почта подтверждена!СПАСИБО!');
    }

    public function unsetEmail($id)
    {
        return view('pages.unsubscribe', ['id' => e($id)]);
    }

    public function unsets(Request $request)
    {

        if(Subscription::unscriber($request->get('email'))){
            return redirect('/')->with('status', 'Вы успешно отписались от рассылки');
        };
        return redirect('/')->with('status', 'Вы не можете отписались от рассылки');

    }
}
