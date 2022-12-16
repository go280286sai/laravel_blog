<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $tags = Tag::all();
        if (Gate::denies('tag', $tags)) {
            abort(404);
        }

        return view('admin.tags.index', ['tags' => $tags, 'i' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        if (Gate::denies('tag', Tag::class)) {
            abort(404);
        }

        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TagRequest  $request
     * @return RedirectResponse
     */
    public function store(TagRequest $request): RedirectResponse
    {
        $tag = new Tag();
        if (Gate::denies('tag', $tag)) {
            abort(404);
        }
        $tag->title = $request->input('title');
        $tag->slug = Str::of($request->input('title'))->slug('-');
        $tag->save();

        return redirect()->route('tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        $tag = Tag::all()->find($id);
        if (Gate::denies('tag', $tag)) {
            abort(404);
        }

        return view('admin.tags.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TagRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(TagRequest $request, int $id): RedirectResponse
    {
        $tag = Tag::find($id);
        if (Gate::denies('tag', $tag)) {
            abort(404);
        }
        $tag->title = $request->input('title');
        $tag->save();

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $tag = Tag::find($id);
        if (Gate::denies('tag', $tag)) {
            abort(404);
        }
        $tag->remove();

        return redirect()->route('tags.index');
    }
}
