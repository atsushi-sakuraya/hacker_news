@extends('layouts.app')

@section('header')
    <header>
        <div id="profile-header" class="edit">
            <div id="profile-header-banner">
                <div class="back"><a href="/profile">←</a></div>
                <div class="profile-name">プロフィールを編集</div>
                {{Form::submit('保存', ['class' => 'submit', 'form' => 'profile-form'])}}
            </div>
            <div id="profile-header-photo" style="background-image: url('{{ url($user->profile_header_photo) }}');">
                <label class="edit-image">
                    {{Form::file('profile_photo[header]', ['class' => 'edit-photo', 'id' => 'banner-photo', 'accept' => 'image/*', 'form' => 'profile-form'])}}
                </label>
            </div>
            <div id="profile-header-info">
                <div id="profile-header-icon" style="background-image: url('{{ url($user->profile_icon_photo) }}');">
                    <label class="edit-image">
                        {{Form::file('profile_photo[icon]', ['class' => 'edit-icon', 'id' => 'icon-photo', 'accept' => 'image/*', 'form' => 'profile-form'])}}
                    </label>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')

    @include('layouts.flashmessage')
    <div id="profile">
        {{Form::open(['url' => 'profile/store', 'id' => 'profile-form', 'enctype' => 'multipart/form-data'])}}
            {{Form::hidden('id', $auth->id)}}
            <ul class="profile-items">
                <li class="name">
                    {{Form::label('name', '名前')}}
                    {{Form::text('name', $user->name)}}
                </li>
                <li class="self-produce">
                    {{Form::label('self_produce', '自己紹介')}}
                    {{Form::textarea('self_produce', $user->self_produce)}}
                </li>
                <li class="birth">
                    {{Form::label('birth_year', '生年月日')}}
                    {{Form::text('birth_year', $user->birth_year, ['class' => 'birthyear', 'minLength' => 4, 'maxLength' => 4, 'placeholder' => 1993])}}
                    &#047;
                    {{Form::text('birth_month', $user->birth_month, ['class' => 'birthmonth', 'minLength' => 2, 'maxLength' => 2, 'placeholder' => 1])}}
                    &#047;
                    {{Form::text('birth_day', $user->birth_day, ['class' => 'birthday', 'minLength' => 2, 'maxLength' => 2, 'placeholder' => 1])}}
                </li>
            </ul>
        {{Form::close()}}
    </div>
@endsection
