<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        // foreach($articles as $article){
        //     $user = $article->user;
        //     $userNames[] = $user->name;
        // }
        
        //認証済みユーザーが記事のユーザーIDと一致するか比較し、一覧画面で更新削除メニューを一致する場合のみ表示するようにする
        // collectionのeachメソッドで各記事情報に処理を行い、created_date、matched(boolean)を追加
        $articles->each(function($article){
            $article->user_name = $article->user->name; //投稿ユーザー名
            $created_at = $article->created_at;
            $article->created_date = date("Y/m/d H:i:s", strtotime($created_at));
            $article->matched  = false;
            if(Auth::id() === $article->user_id){
                $article->matched = true;
            }
            return $article;
        });
        //dd($articles);

        return view('articles.index',compact('articles'));
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

    /**
     * 記事更新画面の表示
     */
    public function edit(Article $article)
    {
        
        return view('articles.edit', compact('article'));
    }

    /**
     * 記事更新処理
     * 
     * 引数：フォームリクエストデータ＋ 更新対象のレコードを記事モデルからDIして取得
     */
    public function update(ArticleRequest $request, Article $article)
    {
        // 記事IDを取得
        // $articleId = $request->id;
        // 記事IDをもとに更新対象のレコードを1件取得
        // $article = $this->article->find($articleId);

        try{
            // トランザクション開始
            DB::beginTransaction();
            // 更新対象のレコードの更新処理実行
            $isUpdated = $this->article->updateArticle($request, $article);
            //処理に成功したらコミット
            DB::commit();
        }catch(\Throwable $e){
            // 処理に失敗したらロールバック
            DB::rollback();

            return redirect()->route('articles.index')->with('error','記事の更新に失敗しました。');
        }

        return redirect()->route('articles.index')->with('success','記事の更新に成功しました。');
    }
}
