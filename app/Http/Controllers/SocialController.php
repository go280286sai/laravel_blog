<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|RedirectResponse
     */
    public function facebookRedirect(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * @return Application|\Illuminate\Http\RedirectResponse|Redirector|void
     */
    public function loginWithFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();

            if ($isUser) {
                Auth::login($isUser);

            } else {
                $createUser = new User();
                $createUser->name = $user->name;
                $createUser->email = $user->email;
                $createUser->fb_id = $user->id;
                $createUser->password = encrypt('user');
                $createUser->save();
                Auth::login($createUser);

            }
            Log::info('Enter with Facebook: '.Auth::user()->name);
            return redirect('/admin/dashboard');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|RedirectResponse
     */
    public function githubRedirect(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * @return Application|\Illuminate\Http\RedirectResponse|Redirector|void
     */
    public function loginWithGithub()
    {
        try {
            $user = Socialite::driver('github')->user();
            $isUser = User::where('github_id', $user->id)->first();

            if ($isUser) {
                Auth::login($isUser);

            } else {
                $createUser = new User();
                $createUser->name = $user->name;
                $createUser->email = $user->email;
                $createUser->github_id = $user->id;
                $createUser->password = encrypt('user');
                $createUser->save();
                Auth::login($createUser);

            }
            Log::info('Enter with GitHub: '.Auth::user()->name);
            return redirect('/admin/dashboard');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
