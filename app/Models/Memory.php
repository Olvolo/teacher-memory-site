<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    protected $fillable = [
        'name',
        'content',
        'file_path',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
