@extends('app')

@section('title', 'ユーザー登録')

@section('content')


<register-as-user url-register="{{route('register')}}" />

@endsection
