<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store_post(Request $request){
        $validated = $request->validate([
            'name' => ['required' , 'max:10'] ,
            'content' => ['required'] ,
            'tags' => ['required'] ,
            'is_visible' => ['sometimes' , 'in:true,false'],
        ]);
        $validated['user_id'] = Auth::user()->id;
        $post = Post::create($validated);
        $post->id;
        $post_id = $post->id;
        return redirect("/add-thumbnail/$post_id")->with('success' , "You successfully create a post!");
    }

    public function single_post(Post $post){

        return view('post.single-post' , ['post' => $post]);
    }


    public function delete(Post $post){
        if(auth()->user()->cannot('delete' , $post)){
            return 'You cannot do that!';
        }else{
            $post->delete();
            $user_id = auth()->user()->id;
            return redirect("/profile/$user_id")->with('success' , 'You successfully deleted the post');
        }
    }


    public function edit_form(Post $post){
        if(auth()->user()->cannot('update' , $post)){
            return 'You cannot do that!';
        }else{
            return view('post.edit-post-page' , ['post' => $post]);
        }
    }

    public function update_post(Request $request , Post $post){
        $validated = $request->validate([
            'name' => ['required' , 'max:10'] ,
            'content' => ['required'] ,
            'tags' => ['required'] ,
            'is_visible' => ['sometimes' , 'in:true,false'],
        ]);
        $validated['user_id'] = Auth::user()->id;
        $post->update($validated);
        $post->id;
        $post_id = $post->id;
        return back()->with('success' , "You successfully create a post!");
    }



}
