<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function index()
    {
        // basic stats
        $posts = Post::count();
        $users = User::count();
        $comments = Comment::count();

        // recent activity
        $recentPosts = Post::with('author')->latest()->take(5)->get();

        return view('admin.dashboard', compact('posts','users','comments','recentPosts'));
    }
}
