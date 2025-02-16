<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'type',
        'file_path',
        'title',
        'description'
    ];

    protected $casts = [
        'type' => 'string'
    ];

    public function scopePhotos($query)
    {
        return $query->where('type', 'photo');
    }

    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    public function scopeAudios($query)
    {
        return $query->where('type', 'audio');
    }
}
