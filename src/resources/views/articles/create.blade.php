@extends('app')

@section('title', '記事投稿')

@section('content')
    @include('error_list')
    <article-create 
      url-articles-store="{{ route('articles.store') }}"
      :authorized='@json(Auth::check())'
      url-logout="{{ route('logout') }}"
      url-articles-create="{{ route('articles.create') }}"
    />

@endsection