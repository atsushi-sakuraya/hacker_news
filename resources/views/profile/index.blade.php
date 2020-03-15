@extends('layouts.app')

@section('header')
    <header>
        <div id="profile-header">
            <div id="profile-header-banner">
                <span class="back"><a href="/">←</a></span>
                <div class="profile-name">{{ $user->name }}</div>
            </div>
            <div id="profile-header-photo" style="background-image: url('{{ $user->profile_header_photo }}')"></div>
            <div id="profile-header-info">
                <div id="edit-profile">
                    {{Form::button('プロフィールを編集', ['class' => 'edit-profile-btn', 'onclick' => 'location.href="/profile/edit"'])}}
                </div>
                <div id="profile-header-icon" style="background-image: url('{{ $user->profile_icon_photo }}')"></div>
                <div id="profile-header-kana">{{ $user->name }}</div>
                <div id="profile-header-comment">{{ $user->self_produce }}</div>
                <div id="profile-header-friends">
                    <div class="follows"><span class="bold">{{ $user->follow }}</span> フォロー</div>
                    <div class="followers"><span class="bold">{{ $user->follower }}</span> フォロワー</div>
                </div>
            </div>
            <div id="profile-header-nav">
                <ul id="profile-tabs">
                    <li class="selected-nav"><a href="/profile">投稿</a></li>
                    <li><a href="/profile">投稿と返信</a></li>
                    <li><a href="/profile">メディア</a></li>
                    <li><a href="/profile">いいね</a></li>
                </ul>
            </div>
        </div>
    </header>
@endsection

@section('content')
    @guest
        <ul>
            未ログインのためプロフィール非表示
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        </ul>
    @else

        @include('postlists')

    @endguest
@endsection
