@extends('layout')

@section('title', 'Homepage')

@section('content')
    <h2 class="m-3">Homepage</h2>

    <div class="mb-3">
        <a class="btn btn-secondary" href="/categories">Categories</a>
    </div>
    <div class="mb-3">
        <a class="btn btn-secondary" href="/posts">Posts</a>
    </div>
    <div class="mb-3">
        <a class="btn btn-secondary" href="/tags">Tags</a>
    </div>
@endsection