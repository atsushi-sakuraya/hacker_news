@extends('layouts.app')
@section('content')

    @include('layouts.flashmessage')
    <div class="post">
        {{ Form::open(['url' => '/post', 'enctype' => 'multipart/form-data']) }}
            {{ Form::hidden('user_id', $auth->id) }}
            {{ Form::textarea('comment', '', ['class' => 'post__textarea--sp', 'placeholder' => 'なにを発信する？']) }}
            <div class="news">
                {{ Form::url('article_url', '', ['class' => 'upload__input--news', 'placeholder' => 'ニュースURLを入力']) }}
            </div>
            <div class="preview">
                <ul class="preview-images"></ul>
                <ul class="preview-articles"></ul>
            </div>
            <div class="toolbar">
                <ul class="toolbar-lists">
                    <li class="toolbar-images">
                        <label class="upload__label--images">
                            +
                            {{ Form::file('images[]', ['class' => 'upload__btn--images', 'id' => 'upload__btn--images', 'multiple' => 'multiple', 'accept' => 'image/*']) }}
                        </label>
                    </li>
                </ul>
            </div>
            <div class="submit">
                {{ Form::submit() }}
            </div>
        {{ Form::close() }}
    </div>

@endsection
