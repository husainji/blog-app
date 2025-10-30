<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
        $this->middleware('log.activity');
    }

    public function index()
    {
        // Cache posts list for 60 seconds
        $posts = Cache::remember('posts.index', 60, function () {
            return Post::with('author')->latest()->paginate(10);
        });

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['title'=>'required|string|max:255','content'=>'required']);
        $data['user_id'] = Auth::id();
        $post = Post::create($data);
        Cache::forget('posts.index');

        // broadcast or notify
        event(new \App\Events\PostCreated($post));

        return redirect()->route('posts.show',$post)->with('success','Post created');
    }

    public function show(Post $post) // route model binding
    {
        // eager load comments
        $post->load(['comments.user']);
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update',$post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update',$post);
        $data = $request->validate(['title'=>'required|string|max:255','content'=>'required']);
        $post->update($data);
        Cache::forget('posts.index');
        return redirect()->route('posts.show',$post)->with('success','Post updated');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        Cache::forget('posts.index');
        return redirect()->route('posts.index')->with('success','Post deleted');
    }
}
