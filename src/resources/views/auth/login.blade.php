@extends('app')

@section('title', 'ログイン')

@section('content')

@include('error_list')

    <login-form 
      url-login="{{ route('login') }}"
      url-register="{{ route('register') }}"
    />


@endsection
