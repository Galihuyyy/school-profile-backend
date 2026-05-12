<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $table = 'tr_jobs', $guarded = [];

    public function job_requirements()
    {
        return $this->hasMany(JobRequirement::class, 'job_id', 'id');
    }
}
