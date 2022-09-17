<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->article = new Article();
    }
    
    /**
     * 記事一覧画面
     */
    public function index()
    {
        //$articles = $this->article->getAllArticleData();
        
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

        return view('articles.index',compact('articles'));
    }

    /**
     * 記事投稿画面の表示
     */
    public function create()
    {
        return view('articles.create');
    }
}
