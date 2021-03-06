@extends('layouts.admin')
@section('content')

{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
<div class="c-admin__title">ユーザー削除画面</div>

<div class="c-admin__confirm">以下の情報を削除しますか？</div>

<div class="admin__userEdit">
    <form method="POST" action="{{ route('admin.user.delete') }}">
        @csrf
        @foreach($users as $user)
        <input type="hidden" name="delete_id[]" value="{{ $user->id }}">
        <div class="c-admin__user__info">
            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">id </div>
                <span>{{ $user->id }}</span>
            </div>
            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">group</div>
                <span>{{ $user->group }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">名前</div>
                <span>{{ $user->account_name }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">肩書き</div>
                <span>{{ $user->title }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">自己紹介</div>
                <span>{{ $user->detail }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">メールアドレス</div>
                <span>{{ $user->email }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">作成日</div>
                <span>{{ $user->created_at }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">更新日</div>
                <span>{{ $user->updated_at }}</span>
            </div>

        </div>
        @endforeach
        <div class="c-admin__userEdit__btn">
            <button type="submit" class="c-admin__btn">削除する</button>
        </div>

    </form>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @endsection
</div>
