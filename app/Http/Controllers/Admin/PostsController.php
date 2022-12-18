<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Mail\SendMessageEmail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        if (Auth::user()->is_admin) {
            $posts = Post::all();
        } else {
            $posts = Post::all()->where('user_id', '=', Auth::user()->id);
        }

        return view('admin.posts.index', ['posts' => $posts, 'i' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        return view('admin.posts.create', ['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest  $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $post = Post::add($request->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        $post->toggleFeatured($request->get('is_featured'));

        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        $post = Post::all()->find($id);
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $selectedTags = $post->tags->pluck('id')->all();

        return view('admin.posts.edit', compact(
            'categories',
            'tags',
            'post',
            'selectedTags'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     *
     * @throws AuthorizationException
     */
    public function update(PostRequest $request, int $id): RedirectResponse
    {
        $post = Post::all()->find($id);
        $this->authorize('update', $post);
        $post->edit($request->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        $post->toggleStatus($request->get('status'));
        $post->toggleFeatured($request->get('is_featured'));

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        DB::transaction(function () use ($id) {
            Post::find($id)->remove();
            Comment::where('post_id', '=', $id)->delete();
        });

        return redirect()->route('posts.index');
    }

    /**
     * @param  Request  $request
     * @return View
     */
    public function viewCommentPost(Request $request): View
    {
        $id = $request->get('id');
        $comment = $request->get('comment');

        return view('admin.posts.comment', ['id' => $id, 'comment' => $comment]);
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function addCommentPost(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $content = $request->get('content');
        $post = Post::all()->find($id);
        $post->comment = $content;
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * @param  Request  $request
     * @return View
     */
    public function viewMailPost(Request $request): View
    {
        $email = $request->email;
        $title = $request->title;

        return view('admin.posts.mail', ['email' => $email, 'title' => $title]);
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function sendMailPost(Request $request): RedirectResponse
    {
        Mail::to($request->email)->cc(Auth::user()->email)->send(new SendMessageEmail($request->all()));

        return redirect()->route('posts.index');
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
            Post::onlyTrashed()->where('id', '=', $id)->forceDelete();

            return redirect()->route('posts_trash');
        } elseif ($target == 'recover') {
            $id = $request->get('id');
            $this->getRecover($id);

            return redirect()->route('posts_trash');
        } elseif ($target == 'recover_all') {
            $posts = Post::onlyTrashed()->get();
            foreach ($posts as $post) {
                $this->getRecover($post->id);
            }

            return redirect()->route('posts_trash');
        } elseif ($target == 'trash_all') {
            $posts = Post::onlyTrashed()->get();
            foreach ($posts as $post) {
                $this->getTrash($post->id);
            }

            return redirect()->route('posts_trash');
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function getRecover($id): void
    {
        DB::transaction(function () use ($id) {
            Comment::onlyTrashed()->where('post_id', '=', $id)->restore();
            Post::onlyTrashed()->where('id', '=', $id)->restore();
        });
    }

    /**
     * @param $id
     * @return void
     */
    public function getTrash($id): void
    {
        DB::transaction(function () use ($id) {
            Comment::onlyTrashed()->where('post_id', '=', $id)->forceDelete();
            Post::onlyTrashed()->where('id', '=', $id)->forceDelete();
        });
    }

    /**
     * @param  Request  $request
     * @return View
     */
    public function trash(Request $request): View
    {
        $trash = Post::onlyTrashed()->get();

        return view('admin.posts.trash', ['trash' => $trash]);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function toggle($id): RedirectResponse
    {
        $post = Post::find($id);
        $post->toggleStatus();

        return redirect()->back();
    }
}
