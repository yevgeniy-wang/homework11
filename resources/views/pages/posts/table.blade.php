@extends('layout')

@section('title', 'Posts')

@section('content')

    @if (isset($_SESSION['message']))
        <div class="alert alert-{{ $_SESSION['message']['status'] }}" role="alert">
            {{ $_SESSION['message']['text'] }}
        </div>

        @unset ($_SESSION['message'])
    @endif
    <div class="mb-3">
        <a class="btn btn-primary" href="../">Back</a>
    </div>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Slug</th>
            <th>Body</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
        </tr>
        @forelse($table as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->title }}</td>
                <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                <td>{{ $post->slug }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->updated_at }}</td>
                <td>
                    <p><a class="btn btn-primary" href="/posts/{{ $post->id }}/delete">Delete</a></p>
                    <p><a class="btn btn-primary" href="/posts/{{ $post->id }}/edit">Update</a></p>
                </td>
            </tr>

        @empty
            <tr>
                <th><p>no posts</p></th>
            </tr>
        @endforelse
    </table>
    @include('pages.paginator')
    <div class="mb-3">
        <a class="btn btn-primary" href="/posts/create">Add new post</a>
    </div>
@endsection