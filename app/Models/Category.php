<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Get the comments for the blog post.
     */
    public function articles()
    {
        return $this->hasMany(Recipe::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function blogs()
    {
        return $this->articles()->where('type','blog');
    }

    /**
     * Get the comments for the blog post.
     */
    public function recipes()
    {
        return $this->articles()->where('type','recipe');
    }
}
