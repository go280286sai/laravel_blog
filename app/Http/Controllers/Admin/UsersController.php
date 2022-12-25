<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Mail\SendMessageEmail;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * @param UsersRequest $request
     * @return RedirectResponse
     */
    public function store(UsersRequest $request): RedirectResponse
    {
        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));
        Log::info('Create user: '.$user->name.' --'. Auth::user()->name);

        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $user = User::all()->find($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param UsersRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [
            'phone'=>'min:10'
        ]);
        $user=User::edit($request->all(), $id); //name,email
        $user->uploadAvatar($request->file('avatar'));
        Log::info('Update user: '.$user->name.' --'. Auth::user()->name);

        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        DB::transaction(function () use ($id) {
            $posts = Post::where('user_id', '=', $id)->get('id');
            foreach ($posts as $post) {
                Comment::where('post_id', '=', $post->id)->delete();
            }
            Post::where('user_id', '=', $id)->delete();
            User::find($id)->delete();
        });
        Log::info('Delete user: '.$id.' --'. Auth::user()->name);
        if (! Auth::user()->is_admin) {
            return redirect('/');
        }

        return redirect()->route('users.index');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function viewCommentUser(Request $request): View
    {
        $id = $request->get('id');
        $comment = $request->get('comment');

        return view('admin.users.comment', ['id' => $id, 'comment' => $comment]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function addCommentUser(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $content = $request->get('content');
        $user = User::find($id);
        $user->comment = $content;
        $user->save();
        Log::info('Create comment user: '.$user->name.' '.$content.' --'. Auth::user()->name);

        return redirect()->route('users.index');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function viewMailUser(Request $request): View
    {
        $email = $request->email;
        $title = $request->title;

        return view('admin.users.mail', ['email' => $email, 'title' => $title]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendMailUser(Request $request): RedirectResponse
    {
        Mail::to($request->email)->cc(Auth::user()->email)->send(new SendMessageEmail($request->all()));
        Log::info('Send email user: '.$request->email.' '.$request->get('content').' --'. Auth::user()->name);

        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function toggle($id): RedirectResponse
    {
        $user = User::find($id);
        $user->toggleBan($user->status);
        Log::info('Ban user: '.$user->name.' --'. Auth::user()->name);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse|void
     */
    public function recover(Request $request)
    {
        $target = $request->get('target');
        if ($target == 'trash') {
            $id = $request->get('id');
            $this->getTrash($id);
            Log::info('Trash user: '.$id.' --'. Auth::user()->name);

            return redirect()->route('users_trash');
        } elseif ($target == 'recover') {
            $id = $request->get('id');
            $this->getRecover($id);
            Log::info('Recover user: '.$id.' --'. Auth::user()->name);

            return redirect()->route('users_trash');
        } elseif ($target == 'recover_all') {
            $users = User::onlyTrashed()->get();
            foreach ($users as $user) {
                $this->getRecover($user->id);
            }
            Log::info('Recover all users: '.' --'. Auth::user()->name);

            return redirect()->route('users_trash');
        } elseif ($target == 'trash_all') {
            $users = User::onlyTrashed()->get();
            foreach ($users as $user) {
                $this->getTrash($user->id);
            }
            Log::info('Trash all users: '.' --'. Auth::user()->name);

            return redirect()->route('users_trash');
        }
    }

    /**
     * @param Request $request
     * @return View
     */
    public function trash(Request $request): View
    {
        $trash = User::onlyTrashed()->get();

        return view('admin.users.trash', ['trash' => $trash]);
    }

    /**
     * @param $id
     * @return void
     */
    public function getRecover($id): void
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

    /**
     * @param $id
     * @return void
     */
    public function getTrash($id): void
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
