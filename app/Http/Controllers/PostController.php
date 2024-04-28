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
//        dd($posts);
        return view('post.index', compact('posts'));


//        $category = category::find(1);
//        $posts = Post::where('is_published', 1)->get();
//        foreach ($posts as $post)
//            dump($post->title);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);
        $post->tags()->attach($tags);

        //Тут я охеривал (почитать об отношениях подробнее и их реализации)
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
//        $post = Post::findOrFail($id);        public function show($id)
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags); //attach неподходит, т.к. добовляет привязки, но не удаляет те с которыми уже не связан
//        $post = $post->fresh(); не обязательно так как цепляемся к id-щнику
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
