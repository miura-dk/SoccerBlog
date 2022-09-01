<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\ArticleController;

class ArticleControllerTest extends TestCase
{
    // データベースの初期化にトランザクションを使う
    // use DatabaseTransactions;

    use RefreshDatabase;

    /**
     * articlecontroller index
     *
     * @return void
     */
    public function test_index()
    {
        //GETリクエスト
        $response = $this->get('/');

        $response->assertStatus(200);
    }

}
