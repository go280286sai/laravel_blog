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
        try {
            $user = Auth::user();
            Log::info('Api get profile: ' . $user->id . ' ' . $user->name . ' ' . $user->email);
            return response()->json($user);
        }catch (\Exception $e) {
            Log::info('Api error profile: ' . $user->id . ' ' . $user->name . ' ' . $user->email);
            return response()->json(['status' => 'error'])->setStatusCode(400);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            User::edit($request->all(), $user->id);
            Log::info('Api update profile, status ok: ' . $user->id . ' ' . $user->name . ' ' . $user->email);
        }catch (\Exception $e) {
            Log::info('Api update profile, status error: ' . $user->id . ' ' . $user->name . ' ' . $user->email);
            return response()->json(['status' => 'error'])->setStatusCode(400);
        }
        return response()->json(['status' => 'ok']);
    }

}
