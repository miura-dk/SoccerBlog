<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    use HasFactory;

    /**
     * userリレーション設定
     */
    public function users():BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * articlesリレーション設定
     */
    public function articles():BelongsTo
    {
        return $this->belongsTo('App\Models\Article');
    }
}
