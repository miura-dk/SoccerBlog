@extends('app')

@section('title', 'ユーザー登録')

@section('content')

@include('error_list')
<register-as-user
 url-register="{{route('register')}}"
 url-login-form="{{route('login')}}"
/>

@endsection
