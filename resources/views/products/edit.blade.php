@extends('layouts.app')

@section('content')
<div class="new">
    <section class="new__wrapper">
        <div class="">レッスン内容登録</div>

        <div class="">
            <form method="POST" action="{{ route('products.create') }}" enctype="multipart/form-data" >
                @csrf
                {{-- 名前 --}}
                <div class="">
                    <label for="name" class="">名前</label>

                    <div class="">
                        <input id="name" type="text" class="new__input-area @error('name') is-invalid @enderror"
                            name="name" value="{{ $product->name }}" autocomplete="name" autofocus>

                        @error('name')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                {{-- 言語選択 --}}
                <div class="searchbox">
                    <div class="serchbox__inner">
                        <p>1.言語を選んでね</p>
                    <div for="lang" class="">言語</div>

                    <div class="">

                        @foreach ($category as $categories)
                            <input id="lang" type="checkbox" class="new__input-area @error('lang') is-invalid @enderror"
                                name="lang[]" value="{{ $categories->id }}" autocomplete="lang" autofocus 
                                @if(
                                $product->categories->contains(function ($category1) use ($categories) {
                                    return $category1->id === $categories->id;
                                })
                                ) checked @endif>{{ $categories->name }}
                        @endforeach

                        @foreach ($difficult as $difficults)
                            <input id="difficult" type="checkbox" class="new__input-area @error('difficult') is-invalid @enderror"
                                name="difficult[]" value="{{ $difficults->id }}" autocomplete="difficult" autofocus>{{ $difficults->name }}
                        @endforeach
                       
                        @error('name')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </div>
                </div>

                {{-- 説明 --}}
                <div class="">
                    <label for="detail"
                        class="">説明</label>

                    <div class="">
                        <input id="detail" type="text"
                            class="new__input-area @error('detail') is-invalid @enderror" name="detail"
                            value="{{ old('detail') }}" autocomplete="detail" autofocus>

                        @error('detail')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- レッスン内容 --}}
                <div class="">
                    <label for="lesson" class="">レッスン内容</label>

                    <div class="">
                        <input id="lesson" type="text" class="new__input-area @error('lesson') is-invalid @enderror"
                            name="lesson" value="{{ old('lesson') }}" autocomplete="lesson" autofocus>

                        @error('lesson')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- 価格 --}}
                <div class="">
                    <label for="default_price" class="">価格</label>

                    <div class="">
                        <input id="default_price" type="text" class="new__input-area @error('default_price') is-invalid @enderror"
                            name="default_price" value="{{ old('default_price') }}" autocomplete="default_price" autofocus>

                        @error('default_price')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- 画像 --}}
                <div class="c-image__preview">
                    <p class="c-delete__file">消す</p>
                    <label class="c-area__drop">
                        <input class="c-input__file" type="file" name="pic1" >
                        <img src="" alt=""  class="c-prev__img">
                    ドラッグ＆ドロップ
                    </label>
                </div>

                {{-- @for ($i = 1; $i <= 10; $i++) <div class="form-group row">
                    <label for="problem0"
                        class="col-md-4 col-form-label text-md-right">{{ __('Problem').$i }}</label>

                <div class="col-md-6">
                    <input id="problem{{$i - 1}}" type="text"
                        class="form-control @error('problem'.($i - 1)) is-invalid @enderror"
                        name="problem{{$i - 1}}" value="{{ old('title') }}" autocomplete="problem{{$i - 1}}"
                        autofocus>

                    @error('problem'.($i - 1))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
        </div>
        @endfor --}}


                <button type="submit" class="">
                    {{ __('Register') }}
                </button>
        </form>
    </div>
</section>
</div>
@endsection