<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $posts = Post::search($search)->get();

        return view('search.index', ['posts' => $posts]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function show(Request $request): View
    {
        $search = $request->get('search');
        $posts = Post::search($search)->get();
        if (Auth::user()->is_admin) {
            $users = User::search($search)->get();
            $comments = Comment::search($search)->get();
            $subscriptions = Subscription::search($search)->get();

            return view('admin.search.index', ['posts' => $posts, 'users' => $users, 'comments' => $comments, 'subs' => $subscriptions, 'i'=>1]);
        } else {
            $posts = $posts->where('user_id', '=', Auth::user()->id);

            return view('admin.search.index', ['posts' => $posts]);
        }
    }
}
