<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();

            if ($isUser) {
                Auth::login($isUser);

                return redirect('/admin/dashboard');
            } else {
                $createUser = new User();
                $createUser->name = $user->name;
                $createUser->email = $user->email;
                $createUser->fb_id = $user->id;
                $createUser->password = encrypt('user');
                $createUser->save();
                Auth::login($createUser);

                return redirect('/admin/dashboard');
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function loginWithGithub()
    {
        try {
            $user = Socialite::driver('github')->user();
            $isUser = User::where('github_id', $user->id)->first();

            if ($isUser) {
                Auth::login($isUser);

                return redirect('/admin/dashboard');
            } else {
                $createUser = new User();
                $createUser->name = $user->name;
                $createUser->email = $user->email;
                $createUser->github_id = $user->id;
                $createUser->password = encrypt('user');
                $createUser->save();
                Auth::login($createUser);

                return redirect('/admin/dashboard');
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
