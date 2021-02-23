@extends('layout')

@section('title', 'Post creating')

@section('content')
    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                   value="{{ $_SESSION['data']['title'] ?? $post->title }}">
        </div>
        @if (isset($_SESSION['errors']['title']))
            @foreach($_SESSION['errors']['title'] as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug"
                   value="{{ $_SESSION['data']['slug'] ?? $post->slug }}">
        </div>
        @if (isset($_SESSION['errors']['slug']))
            @foreach($_SESSION['errors']['slug'] as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" id="body" name="body"
                      rows="3">{{ $_SESSION['data']['body'] ?? $post->body }}</textarea>
        </div>
        @if (isset($_SESSION['errors']['body']))
            @foreach($_SESSION['errors']['body'] as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif


        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select id="category" name="category" class="form-select" aria-label="Default select example">
                <option selected>Choose category</option>
                @foreach($categories as $category)
                    <option @if(isset($_SESSION['data']['category']) && $_SESSION['data']['category'] == $category->id) selected
                            @elseif(isset($category_id) && $category_id == $category->id) selected
                            @endif value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        @if (isset($_SESSION['errors']['category']))
            @foreach($_SESSION['errors']['category'] as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="mb-3">
            <div class="form-check">
                @foreach($tags as $tag)
                    <input class="form-check-input"
                           @if(isset($_SESSION['data']['tags']) && in_array($tag->id, $_SESSION['data']['tags']))
                                checked
                           @elseif (isset($tag_id) && in_array($tag->id, $tag_id))
                                checked
                           @endif type="checkbox" value="{{ $tag->id }}" id="tags" name="tags[]">
                    <label class="form-check-label" for="tags">
                        {{ $tag->title }}
                    </label>
                    <br>
                @endforeach
            </div>
        </div>
        @if (isset($_SESSION['errors']['tags']))
            @foreach($_SESSION['errors']['tags'] as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @php
            unset($_SESSION['errors'])
        @endphp

        <div class="mb-3">
            <input type="submit" class="btn btn-primary mb-3" value="Save">
        </div>
    </form>
    @php
        unset($_SESSION['data']);
    @endphp
@endsection