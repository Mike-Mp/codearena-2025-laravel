<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'body', 'post_id', 'created_at'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
