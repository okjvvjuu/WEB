<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    public function likes() {
        return $this->hasMany('App\Models\Like');
    }

    public function tags() {
        return $this->hasMany('App\Models\Tag');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function comments_count() {
        return $this->comments()->count();
    }

    public function likes_count() {
        return $this->likes()->count();
    }

    public function tags_count() {
        return $this->tags()->count();
    }
}
