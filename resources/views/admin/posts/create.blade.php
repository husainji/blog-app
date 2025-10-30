@extends('layouts.admin')

@section('title', 'Create New Post')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Post</h3>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea name="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Publish
            </button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
