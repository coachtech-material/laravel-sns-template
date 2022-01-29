<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function all_users_likes()
    {
        return $this->belongsToMany(User::class, 'likes')->withPivot('id');
    }

    public function users_likes()
    {
        return $this->belongsToMany(User::class, 'likes')->withPivot('id')->wherePivot('user_id', Auth::id());
    }

    public function users_comments()
    {
        return $this->belongsToMany(User::class, 'comments')->withPivot('id', 'comment');
    }
}
