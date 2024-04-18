@extends('layouts.main')

@section('content')
    <div>
        <form action=" {{ route('post.store') }}" method="post">
            @csrf

            <div class="from-group">
                <label for="title">Title</label>
                <input
                    value="{{ old('title') }}"
                    type="text" name="title" class="form-control" id="title" placeholder="Title">

                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="from-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control" id="content"
                          placeholder="Content">{{ old('content') }}</textarea>
                @error('content')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="from-group">
                <label for="image">Image</label>
                <input value="{{ old('image') }}" type="text" name="image" class="form-control" id="image"
                       placeholder="Image">
                @error('image')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category_id">
                    @foreach($categories as $category)
                        <option
                            {{ old('category_id') == $category->id ? ' selected' : ''}}

                            value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                <select class="form-control" multiple id="tags" name="tags[]">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                    @endforeach
                </select>
            </div>

            <button style="margin: 10px;" type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
