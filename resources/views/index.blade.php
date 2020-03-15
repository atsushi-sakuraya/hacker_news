@extends('layouts.app')

@section('header')
    @include('layouts.header')
@endsection

@section('content')
    @include('postlists')
    <a href="/post"><div class="post-btn">+</div></a>
@endsection
