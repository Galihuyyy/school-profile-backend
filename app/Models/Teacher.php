<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = [];
    protected $table = 'ms_teachers';

    protected $casts = [
        'birth_date' => 'date',
        'join_date' => 'date',
        'active' => 'boolean',
    ];
}
