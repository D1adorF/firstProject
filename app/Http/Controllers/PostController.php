<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\returnArgument;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::all();
        return view('post.index', compact('posts'));


//        $category = category::find(1);
//        $posts = Post::where('is_published', 1)->get();
//        foreach ($posts as $post)
//            dump($post->title);
    }

    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
        ]);
        Post::create($data);
        $categories = Category::all();

        return redirect()->route('post.index', compact('categories'));
    }

    public function show(Post $post)
    {
//        $post = Post::findOrFail($id);        public function show($id)
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
        ]);
        $post->update($data);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');

    }

//    public function delete()
//    {
////        $post = Post::find(6);
////        $post->delete();
////
////        dd('delete page');
//    }


    public function firstOrCreate()
    {

        $antherPost = [
            'title' => 'new phpstorm',
            'content' => 'new content',
            'image' => 'new imagetest.jpg',
            'likes' => 333,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate([
            'title' => 'some title phpstorm',

        ],
            [
                'title' => 'some title phpstorm',
                'content' => 'new content',
                'image' => 'new imagetest.jpg',
                'likes' => 333,
                'is_published' => 1,
            ]);

        dump($post->content);
        dd('finished');
    }

    public function updateOrCreate()
    {

        $antherPost = [
            'title' => 'update_or_create phpstorm',
            'content' => 'update_or_create content',
            'image' => 'update_or_create imagetest.jpg',
            'likes' => 32223,
            'is_published' => 1,
        ];
        $post = Post::updateOrCreate([
            'title' => 'some title not phpstorm'
        ],
            [
                'title' => 'some title phpstorm',
                'content' => 'update_or_create content',
                'image' => 'update_or_create imagetest.jpg',
                'likes' => 32223,
                'is_published' => 1,
            ]);
        dump($post->content);
        dd('end');
    }
}
