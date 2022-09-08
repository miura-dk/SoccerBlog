<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    private $article;

    public function setUp() :void
    {
        parent::setUp();
        $this->article = new Article();
    }

    /**
     * unit test
     *
     * 
     */
    public function test_getAllArticleData()
    {
        /*
        $expect = array(
        [
            'id' => 1,
            'title' => 'ご飯について投稿',
            'content' => '朝ごはんお昼ご飯夕ご飯。。。納豆・食パン',
            'image' => '',
            'created_at' => now()->format('Y/m/d H:i:s'),
            'user' => (object)[
                'id' => 1,
                'name' => 'John',
            ],
        ],
        [
            'id' => 2,
            'title' => '今日のサッカー観戦',
            'content' => 'アーセナルはアトレティコマドリードに前半30分に先制点を許すも、後半終了間際に追いつき、ドローに持ち込みました。',
            'image' => '',
            'created_at' => now()->format('Y/m/d H:i:s'),
            'user' => (object)[
                'id' => 2,
                'name' => 'Chris',
            ],
        ],
        );
        */
        $this->article->create([
            'title' => 'ご飯について投稿',
            'content' => '朝ごはんお昼ご飯夕ご飯。。。納豆・食パン',
            'image' => '',
        ]);
        $exp = 'ご飯について投稿';

        $res = $this->article->getAllArticleData();

        var_dump($res);

        $this->assertSame($exp, $res->title);
    }
}
