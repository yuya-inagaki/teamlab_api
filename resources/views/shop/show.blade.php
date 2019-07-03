@extends('layouts.default')

@section('title', '店舗詳細')

@section('content')
<div class="shop_show">

<h1>{{ $shop->name }}</h1>
<p>{{ $shop->place }}</p>
<a href="{{ url('/shop') }}/{{ $shop->id }}/edit">店舗情報編集</a>

@if( $products != 'none' )

<h2>この店舗の管理商品</h2>
<div class="row">
@foreach ($products as $product)
<?php if(in_array($product->id, $shop_stocks)): ?>
<div class="col-md-4 relative">
    <a class="product-inner" href="{{ url('/product') }}/{{ $product->id }}">
        <div class="image relative" style="background:linear-gradient(180deg, rgba(0, 0, 0, 0.00) 60%, rgba(0, 0, 0, 0.4) 100%),url('{{$product->image}}') center / cover;">
            <span class="name p-bottom-l-10">{{$product->name}}</span>
            <span class="price">￥<?php echo number_format($product->price); ?></span>
        </div>
        <div class="info">
            <p>
            <?php
                $limit=15;
                if(mb_strlen($product->description) > $limit) {
                    $desc = mb_substr($product->description,0,$limit);
                    echo $desc. '...' ;
                } else {
                    echo ($product->description);
                }?>
            </p>
        </div>
    </a>
    <div class="edit_btn">
        <a class="manage delete" href="{{ url('/product') }}/{{ $product->id }}/stock/{{ $shop->id }}"><i class="fas fa-minus-circle"></i> リストから削除</a>
        <a class="manage" href="{{ url('/product') }}/{{ $product->id }}"><i class="fas fa-info-circle"></i> 詳細</a>
    </div>
</div>
<?php endif; ?>
@endforeach
</div>

<h2>この店舗の管理していない商品</h2>
<div class="row">
@foreach ($products as $product)
<?php if(!in_array($product->id, $shop_stocks)): ?>
    <div class="col-md-4 relative">
        <a class="product-inner" href="{{ url('/product') }}/{{ $product->id }}">
            <div class="image relative" style="background:linear-gradient(180deg, rgba(0, 0, 0, 0.00) 60%, rgba(0, 0, 0, 0.4) 100%),url('{{$product->image}}') center / cover;">
                <span class="name p-bottom-l-10">{{$product->name}}</span>
                <span class="price">￥<?php echo number_format($product->price); ?></span>
            </div>
            <div class="info">
                <p>
                <?php
                    $limit=15;
                    if(mb_strlen($product->description) > $limit) {
                        $desc = mb_substr($product->description,0,$limit);
                        echo $desc. '...' ;
                    } else {
                        echo ($product->description);
                    }?>
                </p>
            </div>
        </a>
        <div class="edit_btn">
            <a class="manage add" href="{{ url('/product') }}/{{ $product->id }}/stock/{{ $shop->id }}"><i class="fas fa-plus-circle"></i> リストに追加</a>
            <a class="manage" href="{{ url('/product') }}/{{ $product->id }}"><i class="fas fa-info-circle"></i> 詳細</a>
        </div>
    </div>
<?php endif; ?>
@endforeach
</div>

@else
商品なし
@endif

</div>
@endsection
