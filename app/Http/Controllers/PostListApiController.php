<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostCollection;

class PostListApiController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_visible', 'true')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return new PostCollection($posts);
    }

    public function show(Post $post)
    {
        $token = request()->bearerToken();
        // if user has bearer token it means he logged in
        if ($token) {
            $is_super_admin = auth('sanctum')->user()->is_super_admin;
            $is_admin = auth('sanctum')->user()->is_admin;
            if ($is_super_admin == true) {
                return response()->json($post);
            } else if ($is_admin) {
                if ($post->is_visible == true) {
                    return response()->json($post);
                } else if ($post->user_id = Auth::user()->id) {
                    return response()->json($post);
                } else {
                    abort(403, "You are not able to see this post");
                }
            } else {
                if ($post->is_visible == true) {
                    return response()->json($post);
                } else if ($post->user_id = Auth::user()->id) {
                    return response()->json($post);
                } else {
                    abort(403, "You are not able to see this post");
                }
            }
        } else {
            if ($post->is_visible == true) {
                return response()->json($post);
            } else {
                abort(403);
            }
        }
    }
}
