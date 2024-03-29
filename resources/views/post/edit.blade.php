

@extends('layouts.main')

@section('content')
    <div>
        <form action=" {{ route('post.update', $post->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="from-group">
                <label for="title" >Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $post->title }}">
            </div>
            <div class="from-group">
                <label for="content" >Content</label>
                <textarea name="content" class="form-control" id="content" placeholder="Content" >{{ $post->content }}</textarea>
            </div>
            <div class="from-group">
                <label for="image" >Image</label>
                <input type="text" name="image" class="form-control" id="image" placeholder="Image" value="{{ $post->image }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
