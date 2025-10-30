@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <h2>{{ $post->title }}</h2>
        <p class="text-muted">By {{ $post->author->name }} • {{ $post->created_at->diffForHumans() }}</p>
        <div class="mb-3">{{ $post->content }}</div>

        @can('update', $post)
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
        @endcan

        @can('delete', $post)
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline-block">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
            </form>
        @endcan
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5>Comments ({{ $post->comments->count() }})</h5>
        @auth
            <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                @csrf
                <div class="mb-2">
                    <textarea name="body" class="form-control" rows="2" required></textarea>
                </div>
                <button class="btn btn-primary btn-sm">Comment</button>
            </form>
        @else
            <p><a href="{{ route('login') }}">Login</a> to comment.</p>
        @endauth

        <hr>
        @foreach($post->comments as $comment)
            <div class="mb-2">
                <strong>{{ $comment->user?->name ?? 'Guest' }}</strong>
                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                <p>{{ $comment->body }}</p>
                @can('delete', $comment)
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                @endcan
            </div>
            <hr>
        @endforeach
    </div>
</div>
@endsection
