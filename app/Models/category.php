<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    public function posts()
    {
//        dd($this->hasMany(Post::class, 'post_id', 'id')->toSql());

        return $this->hasMany(Post::class, 'category_id', 'id');
    }

}
