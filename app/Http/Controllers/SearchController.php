<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $posts = Post::search($search)->get();

        return view('search.index', ['posts' => $posts]);
    }

    public function show(Request $request)
    {
        $search = $request->get('search');
        if (Auth::user()->is_admin) {
            $posts = Post::search($search)->get();
            $users = User::search($search)->get();
            $comments = Comment::search($search)->get();
            $subscriptions = Subscription::search($search)->get();

            return view('admin.search.index', ['posts' => $posts, 'users' => $users, 'comments' => $comments, 'subs' => $subscriptions]);
        } else {
            $posts = Post::search($search)->get();
            $posts = $posts->where('user_id', '=', Auth::user()->id);

            return view('admin.search.index', ['posts' => $posts]);
        }
    }
}
