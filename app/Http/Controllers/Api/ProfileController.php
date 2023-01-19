<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $user = Auth::user();
        Log::info('Api get profile: ' . $user->id . ' ' . $user->name . ' ' . $user->email);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $user = Auth::user();
        if (User::edit($request->all(), $user->id)) {
            Log::info('Api update profile, status ok: ' . $user->id . ' ' . $user->name . ' ' . $user->email);
            return response()->json(['status' => 'ok']);
        }
        Log::info('Api update profile, status error: ' . $user->id . ' ' . $user->name . ' ' . $user->email);
        return response()->json(['status' => 'error']);
    }

}
