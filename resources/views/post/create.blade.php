

@extends('layouts.main')

@section('content')
    <div>
        <form action=" {{ route('post.store') }}" method="post">
            @csrf
            <div class="from-group">
                <label for="title" >Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
            </div>
            <div class="from-group">
                <label for="content" >Content</label>
                <textarea name="content" class="form-control" id="content" placeholder="Content"></textarea>
            </div>
            <div class="from-group">
                <label for="image" >Image</label>
                <input type="text" name="image" class="form-control" id="image" placeholder="Image">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
