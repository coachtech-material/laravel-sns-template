@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
@endsection

@section('content')
    <div class="post__alert">
        @if (session('message'))
            <div class="post__alert--success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="post__alert--danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="post__content">
        <div class="cards">
            @foreach ($posts as $post)
                <div class="card">
                    <div class="card__img-wrapper">
                        <img class="card__img" alt="投稿画像" src="{{ asset('storage/post_images/' . $post['image']) }}">
                    </div>
                    <div class="card__body">
                        <h3 class="card__title">{{ $post['user']['name'] }}</h3>
                        <div class="card__item">
                            <div class="card__item-img">
                                @if ($post['users_likes']->isEmpty())
                                    <form action="/likes" method="post">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post['id'] }}">
                                        <button type="submit">
                                            <img src="/img/unlike.png" alt="ハート">
                                        </button>
                                    </form>
                                @else
                                    <form action="/likes/{{ $post['users_likes'][0]['pivot']['id'] }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit">
                                            <img src="/img/like.png" alt="ハート">
                                        </button>
                                    </form>
                                @endif
                                <div>×{{ count($post['all_users_likes']) }}</div>
                            </div>
                            <div class="card__item-text">{{ $post['content'] }}</div>
                            <hr>
                            <div class="card__comments">
                                @foreach ($post->users_comments as $user)
                                    <div>{{ $user['name'] }}さん：{{ $user['pivot']['comment'] }}</div>
                                @endforeach
                            </div>
                        </div>
                        <form class="card__comment-create" action="/comments" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post['id'] }}">
                            <input type="text" name="comment" value="{{ old('comment') }}" placeholder="コメント">
                            <div class="form__button">
                                <button class="form__button-submit" type="submit">コメント</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="paginate">
            {{ $posts->links('vendor.pagination.default') }}
        </div>
    </div>
@endsection
