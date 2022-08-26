<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
    ];

    /**
     * リレーション設定 users
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * リレーション設定 comments
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * リレーション設定 favorites
     */
    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    /**
     * リレーション設定 tags
     */
    public function tags() :BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
