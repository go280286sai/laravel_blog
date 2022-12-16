<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', '=', 1)->orderByDesc('id')->cursorPaginate(2);

        return view('pages.index', ['posts' => $posts]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 1)->firstOrFail();
        $ip = [];
        $post->views += 1;
        $post->save();
        $date = Carbon::now()->addMinutes(5);
        if (Cache::has($slug) && in_array($_SERVER['REMOTE_ADDR'], $ip)) {
            Cache::increment($slug);
            $ip[] = $_SERVER['REMOTE_ADDR'];
        } elseif (! Cache::has($slug)) {
            Cache::add($slug, 1, $date);
            $ip[] = $_SERVER['REMOTE_ADDR'];
        }

        return view('pages.show', compact('post'));
    }

    public function tag($slug)
    {
        $tag = Tag::all()->where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->paginate(2);

        return view('pages.list', ['posts' => $posts]);
    }

    public function category($slug)
    {
        $category = Category::all()->where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->where('status', 1)->paginate(2);

        return view('pages.list', ['posts' => $posts]);
    }
}
