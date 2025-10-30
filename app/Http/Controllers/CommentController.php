<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate(['body'=>'required|string']);
        $data['user_id'] = Auth::id();
        $comment = $post->comments()->create($data);
        // real-time notification event
        event(new \App\Events\CommentCreated($comment));
        return back()->with('success','Comment posted');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete',$comment);
        $comment->delete();
        return back()->with('success','Comment deleted');
    }
}
