@extends('app')

@section('title', '記事一覧')



@section('content')


        <article-index :articles='@json($articles)' />


@endsection
