<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    /**
     * fillable
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image',
    ];

    /**
     * リレーション設定 user
     */
    public function user()
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

    /**
     * articlesテーブルのレコードを全件取得
     * 
     * @param void
     * @return Article articlesテーブル
     */
    public function getAllArticleData()
    {
        return $this->get()->sortByDesc('created_at');
    }

    /**
     * 登録処理
     * articlesテーブルにデータを挿入
     */
    public function insertArticleData($request)
    {
        return $this->create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);
    }
}
