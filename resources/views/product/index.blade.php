@extends('layouts.default')

@if($search)
@section('title', $search.'で検索した結果')
@else
@section('title', '商品一覧')
@endif


@section('content')
<div class="product_index">
    @if(!$search)
    <div class="form">
        <form method="POST" action="{{ url('/product/search') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <p>キーワード検索</p>
            @if($errors->has('name'))
            <span class="error">{{ $errors->first('name') }}</span>
            @endif
            <input type="text" name="name" placeholder="商品名" value="{{ old('name') }}">
            <input class="submit" type="submit" value="キーワード検索">
        </form>
    </div>
    @endif

    @if($search)
    <h1><i class="fas fa-shopping-cart"></i> 「{{$search}}」で検索した結果</h1>
    @else
    <h1><i class="fas fa-shopping-cart"></i> 商品一覧</h1>
    @endif

    @if(count($products)==0)
        <p>該当商品はありません</p>
    @else
        <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4">
            <a class="product-inner" href="{{ url('/product') }}/{{ $product->id }}">
                <div class="image relative" style="background:linear-gradient(180deg, rgba(0, 0, 0, 0.00) 60%, rgba(0, 0, 0, 0.4) 100%),url('{{$product->image}}') center / cover;">
                    <span class="name p-bottom-l-10">{{$product->name}}</span>
                    <span class="price">￥<?php echo number_format($product->price); ?></span>
                </div>
                <div class="info">
                    <p>
                    <?php
                        $limit=35;
                        if(mb_strlen($product->description) > $limit) {
                            $desc = mb_substr($product->description,0,$limit);
                            echo $desc. '...' ;
                        } else {
                            echo ($product->description);
                        }?>
                    </p>
                </div>
            </a>
        </div>
        @endforeach
        </div>
    @endif

    @if($search)
    <a class="btn-link" href="{{url('/product')}}"><i class="fas fa-shopping-cart"></i> 商品一覧へ戻る</a>
    @endif

</div>
@endsection
