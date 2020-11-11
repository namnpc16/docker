<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $table = 'posts';
    protected $fillable = [
        'title', 'content', 'img', 'active', 'slug', 'created_at'
    ];

    public function rolesPostCate()
    {
        return $this->belongsToMany(Category::class);
    }

}
