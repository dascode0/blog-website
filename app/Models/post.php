<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Comment;

class post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'category_id', 'image', 'content'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function savedByUser(){
        return $this->belongsToMany(User::class, 'saves')->withTimestamps();
    }
    public function likedByUser(){
        return $this->belongsToMany(User::class, 'likes','post_id','user_id')->withTimestamps();
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    }
}
