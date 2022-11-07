<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $table = 'blog_posts';

    protected $fillable = [
        'category_id',
        'user_id',
        'slug',
        'title',
        'excerpt',
        'content_raw',
        'content_html',
        'is_published',
        'published_at',
    ];
}
