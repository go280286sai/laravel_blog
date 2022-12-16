<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $subs = Subscription::all();
        if (Gate::denies('subscription', $subs)) {
            abort(404);
        }

        return view('admin.subscribers.index', ['subs' => $subs, 'i' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return view
     */
    public function create(): View
    {
        return view('admin.subscribers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubscriptionRequest  $request
     * @return RedirectResponse
     */
    public function store(SubscriptionRequest $request): RedirectResponse
    {
        $subs = new Subscription();
        if (Gate::denies('subscription', $subs)) {
            abort(404);
        }
        $subs->email = $request->get('email');
        $subs->save();

        return redirect()->route('subscribers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return void
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Subscription::all()->find($id)->remove();
        if (Gate::denies('subscription', Subscription::class)) {
            abort(404);
        }

        return redirect('/admin/subscribers');
    }

    public function recover(Request $request)
    {
        $target = $request->get('target');
        if ($target == 'trash') {
            $id = $request->get('id');
            Subscription::onlyTrashed()->where('id', '=', $id)->forceDelete();

            return redirect()->route('subscribers_trash');
        } elseif ($target == 'recover') {
            $id = $request->get('id');
            Subscription::onlyTrashed()->where('id', '=', $id)->restore();

            return redirect()->route('subscribers_trash');
        } elseif ($target == 'recover_all') {
            Subscription::onlyTrashed()->restore();

            return redirect()->route('subscribers_trash');
        } elseif ($target == 'trash_all') {
            Subscription::onlyTrashed()->forceDelete();

            return redirect()->route('subscribers_trash');
        }
    }

    public function trash(Request $request)
    {
        $trash = Subscription::onlyTrashed()->get();

        return view('admin.subscribers.trash', ['trash' => $trash]);
    }
}
