<div>
    @foreach ($articles as $article)
    <div>
        <div><img src="" alt="画像{{$article->user->id}}"></div>
        <div><h1>タイトル：{{ $article->title }}</h1></div>
        <br>
        <div>名前：{{ $article->user->name }}</div>
        <div>作成日：{{ $article->created_at->format('Y/m/d H:i') }}</div>
        <div>{{ $article->content }}</div>
    </div>
    @endforeach
</div>