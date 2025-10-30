@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Post</div>
    <div class="card-body">
        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input name="title" value="{{ old('title', $post->title) }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" rows="6" class="form-control" required>{{ old('content', $post->content) }}</textarea>
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
