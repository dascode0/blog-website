<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\post;
use App\Models\Comment;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'bio',
    ];
    public function posts(){
        return $this->hasMany(\App\Models\post::class);
    }
    public function savedPosts(){
        return $this->belongsToMany(post::class,'saves')->withTimestamps();
    }
    public function likedPosts(){
        return $this->belongsToMany(post::class,'likes','user_id','post_id')->withTimestamps();
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    } 

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
