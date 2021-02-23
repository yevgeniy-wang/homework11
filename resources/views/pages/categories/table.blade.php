@extends('layout')

@section('title', 'Categories')

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
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }}</td>
                <td>
                    <p><a class="btn btn-primary" href="/categories/{{ $category->id }}/delete">Delete</a></p>
                    <p><a class="btn btn-primary" href="/categories/{{ $category->id }}/edit">Update</a></p>
                </td>
            </tr>

        @empty
            <tr>
                <th><p>no categories</p></th>
            </tr>
        @endforelse
    </table>
    @php
        require_once 'paginator.php'
    @endphp
    <div class="mb-3">
        <a class="btn btn-primary" href="/categories/create">Add new category</a>
    </div>
@endsection