<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $categories = Category::all();
        if (Gate::denies('category', $categories)) {
            abort(404);
        }

        return view('admin.categories.index', ['categories' => $categories, 'i' => 1]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        if (Gate::denies('category', Category::class)) {
            abort(404);
        }

        return view('admin.categories.create');
    }

    /**
     * @param  CategoryRequest  $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = new Category();
        if (Gate::denies('category', $category)) {
            abort(404);
        }
        $category->title = $request->input('title');
        $category->slug = Str::of($request->input('title'))->slug('-');
        $category->save();
        Log::info('Create category: '.$request->input('title'));

        return redirect()->route('categories.index');
    }

    /**
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $category = Category::find($id);
        if (Gate::denies('category', $category)) {
            abort(404);
        }

        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * @param  CategoryRequest  $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, $id): RedirectResponse
    {
        $category = Category::find($id);
        if (Gate::denies('category', $category)) {
            abort(404);
        }
        $category->title = $request->input('title');
        $category->save();
        Log::info('Update category: '.$request->input('title'));
        return redirect()->route('categories.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $category = Category::find($id);
        if (Gate::denies('category', $category)) {
            abort(404);
        }
        Log::info('Remove category: '.$category->title);
        $category->remove();

        return redirect()->route('categories.index');
    }
}
