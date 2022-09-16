@extends('app')

@section('title', '記事一覧')



@section('content')


        <article-index 
        :articles='@json($articles)'
        url-register="{{ route('register') }}"
        :authorized='@json(Auth::check())'
        url-login-form="{{ route('login') }}"
        url-logout="{{ route('logout') }}"
        />


@endsection
