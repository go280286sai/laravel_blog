<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $date = Carbon::now();
        if (Cache::has('home')) {
            $posts = Cache::get('home');
        } else {
            $posts = Post::where('status', '=', 1)->where('s_date', '<=', $date)->orderByDesc('id')->cursorPaginate(2);
            Cache::put('home', $posts);
        }
        return view('pages.index', ['posts' => $posts, 'home' => 'active']);
    }

    /**
     * @param $slug
     * @return View
     */
    public function show($slug): View
    {
        $post = Post::where('slug', $slug)->where('status', 1)->firstOrFail();
        $ip = [];
        $post->views += 1;
        $post->save();
        $date = Carbon::now()->addMinutes(5);
        if (Cache::has($slug) && in_array($_SERVER['REMOTE_ADDR'], $ip)) {
            Cache::increment($slug);
            $ip[] = $_SERVER['REMOTE_ADDR'];
        } elseif (!Cache::has($slug)) {
            Cache::add($slug, 1, $date);
            $ip[] = $_SERVER['REMOTE_ADDR'];
        }

        return view('pages.show', compact('post'));
    }

    /**
     * @param $slug
     * @return View
     */
    public function tag($slug): View
    {
        $tag = Tag::all()->where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->paginate(2);

        return view('pages.list', ['posts' => $posts]);
    }

    /**
     * @param $slug
     * @return View
     */
    public function category($slug): View
    {
        $category = Category::all()->where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->where('status', 1)->paginate(2);

        return view('pages.list', ['posts' => $posts]);
    }
}
