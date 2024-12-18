<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store_post(Request $request){
        $validated = $request->validate([
            'name' => ['required' , 'max:10'] ,
            'content' => ['required'] ,
            'tags' => ['required'] ,
            'is_visible' => ['required'],
        ]);
        $validated['user_id'] = Auth::user()->id;
        $post = Post::create($validated);
        $post->id;
        $post_id = $post->id;
        return redirect("/add-thumbnail/$post_id")->with('success' , "You successfully create a post!");
    }
}
