<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRequirement extends Model
{
    protected $table = 'tr_job_requirements', $guarded = [];

    public function jobs()
    {
        return $this->belongsTo(Jobs::class, 'job_id', 'id');
    }
}
