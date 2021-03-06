@extends('layouts.admin')
@section('content')

<div class="c-admin__title">注文詳細画面</div>

<div class="admin__userEdit">
    <div class="c-admin__user__info">
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">id </div>
            <span>{{ $order->id }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">購入者ユーザーid</div>
            <span>{{ $order->user_id }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">プロダクトid</div>
            <span>{{ $order->product_id }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">販売価格
            </div>
            <span>{{ $order->sale_price }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">payjp 支払いid</div>
            <span>{{ $order->payjp_id }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">ステータス</div>
            <span>{{ $order->status }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">購入日</div>
            <span>{{ $order->created_at }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">更新日</div>
            <span>{{ $order->updated_at }}</span>
        </div>

    </div>
    <div class="c-admin__userEdit__btn">
        <a class="c-admin__btn" href="/admin/orders">戻る</a>
    </div>
    @endsection
</div>