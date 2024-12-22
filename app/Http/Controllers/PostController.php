<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store_post(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:10'],
            'content' => ['required'],
            'tags' => ['required'],
            'is_visible' => ['sometimes', 'in:true,false'],
        ]);
        $validated['user_id'] = Auth::user()->id;
        $post = Post::create($validated);
        $post->id;
        $post_id = $post->id;
        return redirect("/add-thumbnail/$post_id")->with('success', "You successfully create a post!");
    }

    public function single_post(Post $post)
    {

        return view('post.single-post', ['post' => $post]);
    }


    public function delete(Post $post)
    {
        if (auth()->user()->cannot('delete', $post)) {
            return 'You cannot do that!';
        } else {
            $post->delete();
            $user_id = auth()->user()->id;
            return redirect("/profile/$user_id")->with('success', 'You successfully deleted the post');
        }
    }


    public function edit_form(Post $post)
    {
        if (auth()->user()->cannot('update', $post)) {
            return 'You cannot do that!';
        } else {
            return view('post.edit-post-page', ['post' => $post]);
        }
    }

    public function update_post(Request $request, Post $post)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:10'],
            'content' => ['required'],
            'tags' => ['required'],
            'is_visible' => ['sometimes', 'in:true,false'],
        ]);
        $validated['user_id'] = Auth::user()->id;
        $post->update($validated);
        $post->id;
        return redirect("/add-thumbnail/$post->id")->with('success', "You successfully create a post!");
    }


    public function post_list()
    {
        if (auth()->user()->is_super_admin != true or auth()->user()->is_admin != true) {
            return back()->with('failure', "You can't do that");
        } else {
            $posts = Post::all();
            return view('post.post-list', ['posts' => $posts]);
        }
    }

    public function public_post()
    {
        $posts = Post::where('is_visible', 'true')->get();
        return view('post.public-post', ['posts' => $posts]);
    }

    public function upload_change_thumbnail(Request $request, Post $post)
    {

        if (!empty($request['thumbnanil'])) {
            $user_id = $post->user->id;
            $request->validate([
                'thumbnail' => 'nullable|image|max:3000', // Validate image
            ]);
            $fileName = $post->id . '_' . uniqid() . '.jpg';
            $imageData = Image::make($request->file('thumbnail'))->fit(120)->encode('jpg');
            Storage::put('public/thumbnails/' . $fileName, $imageData);
            $oldThumbnail = $post->thumbnail;
            $post->thumbnail = $fileName;
            $post->save();

            if ($oldThumbnail != "/fallback-thumbnail.jpg") {
                Storage::delete(str_replace("/storage/", "public", $oldThumbnail));
            }
            return redirect("/profile/$user_id")->with('success', 'thumbnail successfully uploaded!');
        } else {
            return back()->with('failure', "You cannot upload nothing!");
        }
    }
}
