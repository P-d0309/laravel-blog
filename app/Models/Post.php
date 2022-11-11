<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = [
        'user_id',
        'text',
        'description',
        'thumbnail',
        'seo_description',
        'file',
        'file_type',
        'likes',
        'status',
        'future_date',
        'watch',
    ];

    function Auther() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
