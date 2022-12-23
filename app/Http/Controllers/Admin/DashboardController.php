<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('dashboard');
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Log::info('Logout: '.Auth::user()->name);
        Auth::logout();


        return redirect()->route('login');
    }
}
