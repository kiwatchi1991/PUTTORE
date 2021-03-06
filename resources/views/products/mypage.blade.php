@extends('layouts.app')

@section('content')
<h2 class="c-pageTitle">マイページ</h2>
{{-- @if (session('flash_message'))
<div class="alert alert-success">
    {{ session('flash_message') }}
</div>
@endif --}}
    <div class="c-searchBox">
        <form method="GET" action="{{ route('products') }}" enctype="multipart/form-data" >
            @csrf
            @foreach ($category as $categories)
                <input id="lang" type="checkbox" class="new__input-area @error('lang') is-invalid @enderror"
                    name="lang[]" value="{{ $categories->id }}" autocomplete="lang" autofocus>{{ $categories->name }}
            @endforeach
            @foreach ($difficult as $difficults)
                <input id="difficult" type="checkbox" class="new__input-area @error('difficult') is-invalid @enderror"
                    name="difficult[]" value="{{ $difficults->id }}" autocomplete="difficult" autofocus>{{ $difficults->name }}
            @endforeach
            <button type="submit" class="">
                検索する
            </button>
        </form>
    </div>
    <div class="c-pageNum"> 全 <span class="c-totalNum">{{ $all_products->count() }}</span> 件中 {{ $pageNum_from }} 〜 {{ $pageNum_to }} 件</div>
        <div class="p-product__area">
            @foreach ($products as $product)
            <div class="c-product__block">
            <a class="c-product__link" href="{{ route('products.show', $product->id) }}">
            {{-- プロダクトID {{ $product->id }} --}}
           
                    {{-- <h3 class="">{{ $product->name }}</h3> --}}
                    {{-- <a href="#" class="btn btn-primary">{{ __('Go Practice')  }}</a> --}}
                    {{-- <a href="{{ route('products.edit',$product->id ) }}" --}}
                        {{-- class="">{{ __('Go Practice')  }}</a> --}}
                    <div class="c-image__block">
                        {{-- 画像     --}}
                        {{-- @if ($is_image) --}}
                            <img class="c-image" src="/storage/{{ $product->pic1 }}">
                        {{-- @endif --}}
                    </div>
                    <div class="c-tag__block">
                        
                        {{-- 言語表示 --}}
                        @foreach ($product_categories->find($product->id)->categories as $category)

                        <div class="c-tag c-tag--category">{{ $category->name }}</div>
                        @endforeach 
                        
                        {{-- 難易度表示 --}}
                        @foreach ($product_difficulties->find($product->id)->difficulties as $difficulty)
                        
                        <div class="c-tag c-tag--difficulty">{{ $difficulty->name }}</div>

                        @endforeach
                    </div>
                    <div class="c-contents__block"> 

                        <div class="c-contents__title">{{ $product->name }}</div>
                        <div class="c-contents__detail">{{ $product->detail }}</div>
                        {{-- <div class="c-contents__price">¥ {{ $product->default_price }}</div> --}}
                        <div class="c-contents__price">¥ {{ number_format($product->default_price) }}</div>

                        {{-- <form action="{{ route('products.delete',$product->id ) }}" method="post" class="">
                            @csrf
                            <button class=""
                            onclick='return confirm("削除しますか？");'>{{ __('Go Delete')  }}</button>
                        </form> --}}
                    </div>
            </a>
        </div>
        </div>
        @endforeach
        <div class="c-pagination">
            {{ $products->links() }}
        </div>
</div>
@endsection