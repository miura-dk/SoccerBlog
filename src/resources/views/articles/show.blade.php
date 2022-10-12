@extends('app')

@section('title', '記事一覧')



@section('content')

        <article-show 
        :article='@json($article)'
        url-register="{{ route('register') }}"
        :authorized='@json(Auth::check())'
        url-login-form="{{ route('login') }}"
        url-logout="{{ route('logout') }}"
        url-articles-create="{{ route('articles.create') }}"
        url-articles-show="{{ route('articles.show', ['article' => $article]) }}"
        />

@endsection
