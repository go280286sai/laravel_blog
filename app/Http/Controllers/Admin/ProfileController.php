<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $user = Auth::user();

        return view('admin.profile', ['user' => $user]);
    }

    /**
     * @param ProfileRequest $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(ProfileRequest $request): RedirectResponse
    {

        $user = Auth::user();
        $user->name = $request->get('name');
        $user->birthday = $request->get('birthday') ?? null;
        $user->phone = $request->get('phone') ?? null;
        $user->gender_id = $request->get('gender_id') ?? null;
        $user->myself = $request->get('myself') ?? null;
        if (!empty($request->get('password'))) {
            $user->password = bcrypt($request->get('password'));
        }
        $user->uploadAvatar($request->file('avatar'));
        $user->save();
        Log::info('Update profile: '.Auth::user()->name);

        return redirect()->back()->with('status', __('admin.update_profile'));
    }
}
