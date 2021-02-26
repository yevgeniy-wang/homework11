@extends('layout')

@section('title', 'Tags')

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
            <th>Slug</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
        </tr>
        @forelse($table as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->title }}</td>
                <td>{{ $tag->slug }}</td>
                <td>{{ $tag->created_at }}</td>
                <td>{{ $tag->updated_at }}</td>
                <td>
                    <p><a class="btn btn-primary" href="/tags/{{ $tag->id }}/delete">Delete</a></p>
                    <p><a class="btn btn-primary" href="/tags/{{ $tag->id }}/edit">Update</a></p>
                </td>
            </tr>

        @empty
            <tr>
                <th><p>no tags</p></th>
            </tr>
        @endforelse
    </table>
    @include('pages.paginator')
    <div class="mb-3">
        <a class="btn btn-primary" href="/tags/create">Add new tag</a>
    </div>
@endsection