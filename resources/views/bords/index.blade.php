@extends('layouts.app')
@section('title','メッセージボード')
@section('content')

<div class="c-bords__head">メッセージボード</div>



<div class="c-bords">
    @foreach ($bords as $bord)

    @php

    $buy_userId = $bord->user_id;
    $sell_userId = $bord->{'p.user_id'};
    $order_type = ($buy_userId == $id) ? "buy" : "sell";
    $partnerId = ($order_type == "buy") ? $sell_userId : $buy_userId;

    if($order_type == "buy"){
    $pic = $user->find($sell_userId);
    }else{
    $pic = $user->find($buy_userId);
    }

    $firstmsg = $messages->where('order_id',$bord->id)->first();
    @endphp



    <a class="c-bord__list {{$order_type}}" href="{{ route('bords.show',$bord->id) }}">
        <div class="c-bord__inner">

            <div class="c-bord__half--left">
                <div class="c-bord__userImg__wrapper"
                    style="background-image:url(/storage/{{($pic->pic)?$pic->pic:'images/noavatar.png'}})">
                </div>
            </div>

            <div class="c-bord__half--right">
                <div class="c-bord__half--top">
                    <div class="c-bord__order {{$order_type}}">
                        {{($order_type == "buy")?"購入":"販売"}}
                    </div>
                    <div class="c-bord__title">
                        @php echo mb_strimwidth( $bord->name, 0, 20, '…', 'UTF-8' ); @endphp
                    </div>
                </div>
                <div class="c-bord__half--bottom">
                    <p class="c-bord__latestMsg">
                        {{ ($firstmsg)? mb_strimwidth($firstmsg->msg, 0, 30, '…', 'UTF-8'):'メッセージはありません' }}</p>
                    <p class="c-bord__created">{{ $bord->msg_updated_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        </div>
    </a>
    @endforeach



</div>
@endsection