@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
@endsection

@section('content')
    <div class="post__content">
        <form class="form" action="/posts" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">投稿内容</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="content" value="{{ old('content') }}" />
                    </div>
                    <div class="form__error">
                        @error('content')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">投稿画像</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="file" name="image" />
                    </div>
                    <div class="form__error">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">投稿</button>
            </div>
        </form>
    </div>
@endsection
