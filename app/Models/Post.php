<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'tr_posts', $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function post_categories()
    {
        return $this->belongsTo(PostCategories::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
