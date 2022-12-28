<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * @return View
     */
    public function registerForm(): View
    {
        return view('pages.register');
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function register(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));
        Log::info('Create new user: '.$user->name);

        return redirect('/login');
    }

    /**
     * @return View
     */
    public function loginForm(): View
    {
        return view('pages.login');
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function login(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ])) {
            Log::info('Enter user:'.Auth::user()->name);

            return redirect('/');
        }
        Log::info('Error input login');

        return redirect()->back()->with('status', __('messages.error_input'));
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Log::info('Logout: '.Auth::user()->name);
        Auth::logout();

        return redirect('/login');
    }
}
