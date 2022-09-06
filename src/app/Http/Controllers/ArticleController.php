<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    
    /**
     * 記事一覧画面
     */
    public function index(Article $article)
    {
        //ダミーデータ
        $articles = [
            (object)[
                'id' => 1,
                'title' => 'タイトル1',
                'content' => '本文1',
                'image' => '',
                'created_at' => now()->format('Y/m/d H:i:s'),
                'user' => (object)[
                    'id' => 1,
                    'name' => 'John',
                ],
            ],
            (object)[
                'id' => 2,
                'title' => 'タイトル2',
                'content' => '本文2',
                'image' => '',
                'created_at' => now()->format('Y/m/d H:i:s'),
                'user' => (object)[
                    'id' => 2,
                    'name' => 'Anne',
                ],
            ],
            (object)[
                'id' => 3,
                'title' => 'タイトル3',
                'content' => '本文3',
                'image' => '',
                'created_at' => now()->format('Y/m/d H:i:s'),
                'user' => (object)[
                    'id' => 3,
                    'name' => 'Luna',
                ],
            ],
        ];

        //$articles = $article->all()->sortBy('created_at','DESC');

        return view('articles.index',compact('articles'));
    }
}
