@extends('layouts.app')

@section('title','Posts')

@section('content')
<div class="row">
    <div class="col-md-8">
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h4><a href="{{ route('posts.show',$post) }}">{{ $post->title }}</a></h4>
                    <p class="text-muted">By {{ $post->author->name }} • {{ $post->created_at->diffForHumans() }}</p>
                    <p>{{ Str::limit($post->content, 200) }}</p>
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    </div>

    <div class="col-md-4">
        @auth
            <a href="{{ route('posts.create') }}" class="btn btn-primary mb-2">Create Post</a>
        @endauth
        <!-- sidebar -->
    </div>
</div>
@endsection
