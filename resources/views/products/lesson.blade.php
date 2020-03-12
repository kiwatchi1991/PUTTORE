@extends('layouts.app')

@section('content')

これは{{$p_id}}　の　レッスン{{ $l_id }}
{{-- 出品者 --}}
<div class="c-lessonShow__user">
    <div class="c-lessonShow__userimg">
        <img src="/storage/{{ $user[0]->pic }}" alt="">
    </div>
    <div class="c-lessonShow__username">
        <p>{{ $user[0]->account_name }}</p>
    </div>
</div>

{{-- タイトル --}}
<div class="c-lessonShow__title">
    <h2>{{ $product->name }}</h2>
</div>

{{-- タグ --}}
<div class="c-tag__block">

    {{-- 言語表示 --}}
    @foreach ($product->categories as $category)

    <div class="c-tag c-tag--category {{ $category->class_name }}">{{ $category->name }}</div>
    @endforeach

    {{-- 難易度表示 --}}
    @foreach ($product->difficulties as $difficulty)

    <div class="c-tag c-tag--difficulty {{ $difficulty->class_name }}">{{ $difficulty->name }}</div>

    @endforeach
</div>

{{-- レッスンタイトル --}}
<div class="c-lessonShow__lesson">
    <div class="c-lessonShow__lesson__number">LESSON {{ $this_lesson->number }}</div>
    <div class="c-lessonShow__lesson__title"> {{ $this_lesson->title }}</div>
</div>

@foreach ($all_lessons as $all_lesson)
@php
$l_id = (int) $all_lesson->number
@endphp
<div class="c-lessonShow__toLesson">
    <a href="{{ route('lessons',$p_id ,$l_id }}">LESSON {{$all_lesson->number}}</a>
</div>
LESSON{{ $all_lesson->number }}
{{ $all_lesson->title }}
@endforeach

@endsection