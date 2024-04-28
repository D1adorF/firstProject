<?php

namespace App\Services\Post;

use App\Models\Post;

class Service
{
    public function store($data)
    {
        $tags = $data['tags'];
        unset($data['tags']);
        $post = Post::create($data);
        $post->tags()->attach($tags);
    }

    public function update($post, $data)
    {
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags); //attach неподходит, т.к. добовляет привязки, но не удаляет те с которыми уже не связан
//        $post = $post->fresh(); не обязательно так как цепляемся к id-щнику
    }
}
