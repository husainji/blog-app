@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Create Post</div>
    <div class="card-body">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input name="title" value="{{ old('title') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
            </div>
            <button class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection
