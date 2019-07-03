@extends('layouts.default')

@section('title', '商品一覧')

@section('content')
<div class="product_index">
    <h1><i class="fas fa-shopping-cart"></i> 商品一覧</h1>
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
</div>
@endsection
