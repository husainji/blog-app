@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $posts }}</h3>
                <p>Posts</p>
            </div>
            <div class="icon"><i class="fas fa-file-alt"></i></div>
            <a href="{{ route('admin.posts.index') }}" class="small-box-footer">More info</a>
        </div>
    </div>
    <!-- users, comments boxes -->
</div>

<h3>Recent Posts</h3>
<ul>
    @foreach($recentPosts as $rp)
        <li>{{ $rp->title }} by {{ $rp->author->name }}</li>
    @endforeach
</ul>
@stop
