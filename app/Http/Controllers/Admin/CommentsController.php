<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class CommentsController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        if (Auth::user()->is_admin) {
            $comments = DB::select('SELECT comments.id, text, title, comments.status FROM comments
    INNER JOIN posts on comments.post_id=posts.id where posts.deleted_at is NULL
                                                    AND comments.deleted_at is null order by comments.status;');
        } else {
            $comments = DB::select('SELECT comments.id, text, title, comments.status FROM comments
    INNER JOIN posts on comments.post_id=posts.id where posts.user_id=? and posts.deleted_at is NULL
                                                    AND comments.deleted_at is null
                                                  order by comments.status;', [Auth::user()->id]);
        }
        if (Gate::denies('comment', $comments)) {
            abort(404);
        }

        return view('admin.comments.index', ['comments' => $comments, 'i' => 1]);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function toggle($id): RedirectResponse
    {
        $comment = Comment::find($id);
        if (Gate::denies('comment', $comment)) {
            abort(404);
        }
        $comment->toggleStatus();
        Log::info('Comment true: '.Auth::user()->name);

        return redirect()->back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $comment = Comment::find($id);
        if (Gate::denies('comment', $comment)) {
            abort(404);
        }
        $comment->remove();
        Log::info('Delete comment');

        return redirect()->back();
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse|void
     */
    public function recover(Request $request)
    {
        $target = $request->get('target');
        if ($target == 'trash') {
            $id = $request->get('id');
            Comment::onlyTrashed()->where('id', '=', $id)->forceDelete();
            Log::info('Trash comment: '.Auth::user()->name);

            return redirect()->route('comments_trash');
        } elseif ($target == 'recover') {
            $id = $request->get('id');
            Comment::onlyTrashed()->where('id', '=', $id)->restore();
            Log::info('Recover comment: '.Auth::user()->name);

            return redirect()->route('comments_trash');
        } elseif ($target == 'recover_all') {
            Comment::onlyTrashed()->restore();
            Log::info('Recover all comments: '.Auth::user()->name);

            return redirect()->route('comments_trash');
        } elseif ($target == 'trash_all') {
            Comment::onlyTrashed()->forceDelete();
            Log::info('Trash all comments: '.Auth::user()->name);

            return redirect()->route('comments_trash');
        }
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     */
    public function trash(Request $request): View|Factory|Application
    {
        $trash = Comment::onlyTrashed()->get();
        Log::info('Trash comment: '.Auth::user()->name);

        return view('admin.comments.trash', ['trash' => $trash]);
    }
}
