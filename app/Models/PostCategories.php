<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategories extends Model
{
    protected $table = 'ms_post_categories';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
