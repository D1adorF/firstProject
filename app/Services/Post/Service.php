<?php

namespace App\Services\Post;

use App\Models\Post;
use function PHPUnit\Framework\returnArgument;

class Service
{
    public function store($data)
    {
        $tags = $data['tags'];
        unset($data['tags']);
        $post = Post::create($data);
        $post->tags()->attach($tags);

        return $post;
    }

    public function update($post, $data)
    {
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags); //attach неподходит, т.к. добовляет привязки, но не удаляет те с которыми уже не связан
        return $post->fresh(); //не обязательно когда цепляемся к id-щнику
    }
}
