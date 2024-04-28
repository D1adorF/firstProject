<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags); //attach неподходит, т.к. добовляет привязки, но не удаляет те с которыми уже не связан
//        $post = $post->fresh(); не обязательно так как цепляемся к id-щнику
        return redirect()->route('post.show', $post->id);
    }
}
