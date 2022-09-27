@extends('app')

@section('title', '記事更新')

@section('content')
    <article-edit
      url-articles-create="{{ route('articles.create') }}"
      :authorized='@json(Auth::check())'
      url-logout="{{ route('logout') }}"
      url-articles-update="{{ route('articles.update', ['article' => $article]) }}"
      :article='@json($article)'
    />

@endsection