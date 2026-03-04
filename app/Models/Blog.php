<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['category_id', 'title', 'content', 'feature_image', 'is_published'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
