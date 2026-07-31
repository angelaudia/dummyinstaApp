<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts=Post::with('user')->orderBy('created_at', 'desc')->get();
        return view('posts.index',compact('posts'));
    }

    public function create() {
        return view('posts.create-p');
    }

    public function store(Request $request) {
        $request->validate ([
            'content' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $imagePath = $request->file('image')->store('posts', 'public');

        Post::create ([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'image_path' => $imagePath,
        ]);
        return redirect()-> route('posts.index')->with('success', 'Post successfully added');
    }

    public function destroy (Post $post){
        $post->delete();
        return redirect()-> route('posts.index')->with('success', 'Post successfully deleted');
    }
}
