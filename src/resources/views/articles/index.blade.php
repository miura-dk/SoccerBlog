@extends('app')

@section('title', '記事一覧')



@section('content')

        <article-index 
        :articles='@json($articles)'
        url-register="{{ route('register') }}"
        :authorized='@json(Auth::check())'
        url-login-form="{{ route('login') }}"
        url-logout="{{ route('logout') }}"
        url-articles-create="{{ route('articles.create') }}"
        :initial-usernames='@json($userNames)'
        flash-success-message="{{ session('success') ? session('success') : ''}}"
        flash-error-message="{{ session('error') ? session('error') : ''}}"
        />


@endsection
