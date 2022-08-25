<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
    ];

    /**
     * リレーション設定 comments
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
