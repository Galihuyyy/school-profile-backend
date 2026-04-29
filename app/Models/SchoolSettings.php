<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SchoolSettings extends Model
{
    protected $table = "ms_school_settings", $guarded = [];

    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return null;
        }

        return asset('storage/' . $this->logo);
    }

    public function getProfileVideoEmbedAttribute()
    {
        if (!$this->profile_video) return null;

        $url = $this->profile_video;

        // ambil video ID
        preg_match(
            '/(youtu\.be\/|v=|embed\/|shorts\/)([a-zA-Z0-9_-]{11})/',
            $url,
            $matches
        );

        $videoId = $matches[2] ?? null;

        if (!$videoId) return null;

        return "https://www.youtube.com/embed/" . $videoId;
    }
}
