<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;

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
        $articles = $this->article->getAllArticleData();
        
        //ダミーデータ
        // $articles = [
        //     (object)[
        //         'id' => 1,
        //         'title' => 'タイトル1',
        //         'content' => '本文1',
        //         'image' => '',
        //         'created_at' => now()->format('Y/m/d H:i:s'),
        //         'user' => (object)[
        //             'id' => 1,
        //             'name' => 'John',
        //         ],
        //     ],
        //     (object)[
        //         'id' => 2,
        //         'title' => 'タイトル2',
        //         'content' => '本文2',
        //         'image' => '',
        //         'created_at' => now()->format('Y/m/d H:i:s'),
        //         'user' => (object)[
        //             'id' => 2,
        //             'name' => 'Anne',
        //         ],
        //     ],
        //     (object)[
        //         'id' => 3,
        //         'title' => 'タイトル3',
        //         'content' => '本文3',
        //         'image' => '',
        //         'created_at' => now()->format('Y/m/d H:i:s'),
        //         'user' => (object)[
        //             'id' => 3,
        //             'name' => 'Luna',
        //         ],
        //     ],
        // ];
        foreach($articles as $article){
            $user = $article->user;
            $userNames[] = $user->name;
        }
        

        return view('articles.index',compact('articles','userNames'));
    }

    /**
     * 記事投稿画面の表示
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * 記事投稿機能
     */
    public function store(ArticleRequest $request)
    {
        try{
            // トランザクション開始
            DB::beginTransaction();
            // リクエストデータをarticlesテーブルに登録
            $insertArticle = $this->article->insertArticleData($request);
            //処理に成功したらコミット
            DB::commit();
        }catch(\Throwable $e){
            // 処理に失敗したらロールバック
            DB::rollback();

            return redirect()->route('articles.index')->with('error','記事の投稿に失敗しました。');
        }

        return redirect()->route('articles.index')->with('success','投稿に成功しました。');

    }
}
