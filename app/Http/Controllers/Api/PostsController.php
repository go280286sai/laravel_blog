<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            if (Auth::user()->is_admin) {
                $posts = Post::all();
            } else {
                $posts = Post::all()->where('user_id', '=', Auth::user()->id);
            }
        } catch (\Exception $e) {
            Log::info('Show posts: '.' --'.Auth::user()->name);

            return response()->json(['status' => 'error'])->setStatusCode(400);
        }

        return response()->json($posts);
    }

    public function show($id): JsonResponse
    {
        try {
            if (Auth::user()->is_admin) {
                $posts = Post::find($id);
            } else {
                $posts = Post::find($id)->where('user_id', '=', Auth::user()->id);
            }
            if (! empty($posts)) {
                return response()->json($posts);
            } else {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            Log::info('Show posts: '.' --'.Auth::user()->name);

            return response()->json(['status' => 'error'])->setStatusCode(400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest  $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        try {
            $post = Post::add($request->all());
            $post->uploadImage($request->file('image'));
            $post->toggleFeatured($request->get('is_featured'));
            Log::info('Create post: '.$request->get('title').' '.Auth::user()->name);

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            Log::info('Update post: '.$request->get('title').' --'.Auth::user()->name);

            return response()->json(['status' => 'error'])->setStatusCode(400);
        }
    }

    public function update(PostRequest $request, $id): JsonResponse
    {
        try {
            $post = Post::find($id);
            if ($post->user_id != Auth::user()->id) {
                throw new \Exception();
            }
            $post->edit($request->all(), $id);
            $post->uploadImage($request->file('image'));
            $post->toggleFeatured($request->get('is_featured'));
            Log::info('Update post: '.$request->get('title').' --'.Auth::user()->name);

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            Log::info('Update post: '.$request->get('title').' --'.Auth::user()->name);

            return response()->json(['status' => 'error'])->setStatusCode(400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int|JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $post = Post::find($id);
                if ($post->user_id == Auth::user()->id) {
                    Post::find($id)->remove();
                    Comment::where('post_id', '=', $id)->delete();
                    DB::commit();
                } else {
                    throw new \Exception('Error');
                }
            });
        } catch (\Exception $e) {
            Log::info('Delete post error: '.$id.' --'.Auth::user()->name);

            return response()->json(['status' => 'error'])->setStatusCode(400);
        }
        Log::info('Delete post: '.$id.' --'.Auth::user()->name);

        return response()->json(['status' => 'ok']);
    }
}
