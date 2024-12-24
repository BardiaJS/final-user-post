<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostCollection;

class PostListApiController extends Controller
{
    public function index(){
        $token= request()->bearerToken();
    // if user has bearer token it means he logged in
    if($token){
        $is_super_admin = auth('sanctum')->user()->is_super_admin;
        $is_admin = auth('sanctum')->user()->is_admin;
        if($is_super_admin == true){
            return new PostCollection(Post::paginate());
        }else if($is_admin){
            $public_posts = Post::where('is_visible' , true)->get();

            $currentUserId = Auth::id();

           // Fetch posts where user_id is the current user's id and is_visible is 0
            $private_admin_posts = Post::where('user_id', $currentUserId)
                        ->where('is_visible', false)
                        ->get();

            $merged = $public_posts->merge($private_admin_posts);
            $posts = $merged->all();
            return new PostCollection($posts);
        }else{
            $public_posts = Post::where('is_visible' , true)->get();
            $currentUserId = Auth::id();

           // Fetch posts where user_id is the current user's id and is_visible is 0
            $private_admin_posts = Post::where('user_id', $currentUserId)
                        ->where('is_visible', false)
                        ->get();

            $merged = $public_posts->merge($private_admin_posts);
            $posts = $merged->all();
            return new PostCollection($posts);
        }

    }else{
        $public_posts = Post::where('is_visible' , true)->get();
        return new PostCollection($public_posts);
    }
    }
}
