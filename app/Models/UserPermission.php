<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $table = 'user_permissions', $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
