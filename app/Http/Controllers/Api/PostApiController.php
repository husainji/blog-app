<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index()
    {
        return Post::with('author','comments.user')->latest()->paginate(10);
    }

    public function show(Post $post)
    {
        return $post->load('author','comments.user');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['title'=>'required','content'=>'required']);
        $data['user_id'] = $request->user()->id;
        $post = Post::create($data);
        return response()->json($post,201);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update',$post);
        $post->update($request->only('title','content'));
        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return response()->noContent();
    }
}
