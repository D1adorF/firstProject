@extends('layouts.main')
@section('content')
    <div>
        <div>
            <a href="{{ route('post.create') }}" class="btn btn-primary mb-3">Add new post</a>
        </div>
        @foreach($posts as $post)
            <div><a href="{{ route('post.show', $post->id) }}"><h3>{{ $post->id }}. {{ $post->title  }}</h3></a></div>
        @endforeach
        <div class="mt-4">
            {{ $posts->withQueryString()->links() }}
        </div>
    </div>
@endsection
