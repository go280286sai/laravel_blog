<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMessageEmail;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'avatar' => 'nullable|image',
        ]);
        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::all()->find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::all()->find($id);

        $this->validate($request, [
            'name' => 'required',
            'avatar' => 'nullable|image',
        ]);

        $user->edit($request->all()); //name,email
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $posts = Post::where('user_id', '=', $id)->get('id');
            foreach ($posts as $post) {
                Comment::where('post_id', '=', $post->id)->delete();
            }
            Post::where('user_id', '=', $id)->delete();
            User::find($id)->delete();
        });

        if (! Auth::user()->is_admin) {
            return redirect('/');
        }

        return redirect()->route('users.index');
    }

    public function viewCommentUser(Request $request)
    {
        $id = $request->get('id');
        $comment = $request->get('comment');

        return view('admin.users.comment', ['id' => $id, 'comment' => $comment]);
    }

    public function addCommentUser(Request $request)
    {
        $id = $request->get('id');
        $content = $request->get('content');
        $user = User::find($id);
        $user->comment = $content;
        $user->save();

        return redirect()->route('users.index');
    }

    public function viewMailUser(Request $request)
    {
        $email = $request->email;
        $title = $request->title;

        return view('admin.users.mail', ['email' => $email, 'title' => $title]);
    }

    public function sendMailUser(Request $request)
    {
        Mail::to($request->email)->cc(Auth::user()->email)->send(new SendMessageEmail($request->all()));

        return redirect()->route('users.index');
    }

    public function toggle($id): RedirectResponse
    {
        $comment = User::find($id);
        $comment->toggleBan($comment->status);

        return redirect()->back();
    }

    public function recover(Request $request)
    {
        $target = $request->get('target');
        if ($target == 'trash') {
            $id = $request->get('id');
            $this->getTrash($id);

            return redirect()->route('users_trash');
        } elseif ($target == 'recover') {
            $id = $request->get('id');
            $this->getRecover($id);

            return redirect()->route('users_trash');
        } elseif ($target == 'recover_all') {
            $users = User::onlyTrashed()->get();
            foreach ($users as $user) {
                $this->getRecover($user->id);
            }

            return redirect()->route('users_trash');
        } elseif ($target == 'trash_all') {
            $users = User::onlyTrashed()->get();
            foreach ($users as $user) {
                $this->getTrash($user->id);
            }

            return redirect()->route('users_trash');
        }
    }

    public function trash(Request $request)
    {
        $trash = User::onlyTrashed()->get();

        return view('admin.users.trash', ['trash' => $trash]);
    }

    public function getRecover($id)
    {
        DB::transaction(function () use ($id) {
            $posts = Post::onlyTrashed()->where('user_id', '=', $id)->get('id');
            foreach ($posts as $post) {
                Comment::onlyTrashed()->where('post_id', '=', $post->id)->restore();
            }
            Post::onlyTrashed()->where('user_id', '=', $id)->restore();
            User::onlyTrashed()->where('id', '=', $id)->restore();
        });
    }

    public function getTrash($id)
    {
        DB::transaction(function () use ($id) {
            $posts = Post::onlyTrashed()->where('user_id', '=', $id)->get('id');
            foreach ($posts as $post) {
                Comment::onlyTrashed()->where('post_id', '=', $post->id)->forceDelete();
            }
            Post::onlyTrashed()->where('user_id', '=', $id)->forceDelete();
            User::onlyTrashed()->where('id', '=', $id)->forceDelete();
        });
    }
}
