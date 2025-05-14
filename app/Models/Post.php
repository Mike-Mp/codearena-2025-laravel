<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
        ->where('published_at', '<=', now());
    }

    public function isPublished()
    {
        return $this->published_at && $this->published_at <= now();
    }

    public function scopeHasImage()
    {
        return $this->whereNotNull('image')->where('image', '!=', '');
    }

    public function scopePromoted()
    {
        return $this->where('promoted', true);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
