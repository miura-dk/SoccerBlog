<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment'
    ];

    /**
     * リレーション設定 articles
     */
    public function articles()
    {
        return $this->belongsTo('App\Models\Article');
    }

    /**
     * リレーション設定 users
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
