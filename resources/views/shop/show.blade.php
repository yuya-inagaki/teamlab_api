@extends('layouts.default')

@section('title', '店舗詳細')

@section('content')
</div><!-- //container -->
<div class="shop_show">
    <div class="sec1">
        <div class="container">
            <div><h1>{{ $shop->name }}</h1></div>
            <p>場所：{{ $shop->place }}</p>
            <a class="btn-link" href="{{ url('/shop') }}/{{ $shop->id }}/edit"><i class="far fa-edit"></i> 店舗情報編集</a>
            <a class="btn-link" href="{{ url('/shop') }}/{{ $shop->id }}/destroy"><i class="far fa-edit"></i> 店舗削除</a>
        </div>
    </div><!-- sec1 -->

    @if( $products != 'none' ) <!-- データベースに商品が登録されているかどうかで条件分岐 -->

    <div class="sec2">
        <div class="container">
        <div><h2>この店舗の在庫商品</h2></div>
        @if(count($shop_stocks)==0)
            <p>この店舗の在庫商品はありません</p>
        @else
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
                    <a class="manage delete" href="{{ url('/product') }}/{{ $product->id }}/stock/{{ $shop->id }}"><i class="fas fa-minus-circle"></i> 在庫から削除</a>
                    <a class="manage" href="{{ url('/product') }}/{{ $product->id }}"><i class="fas fa-info-circle"></i> 詳細</a>
                </div>
            </div>
            <?php endif; ?>
            @endforeach
            </div>
        @endif
        </div>
    </div><!-- sec2 -->

    <div class="sec3">
        <div class="container">
            <div><h2>この店舗の管理していない商品</h2></div>
            <div class="row">
            @foreach ($products as $product)
            <?php if(!in_array($product->id, $shop_stocks)): ?>
                <div class="col-md-3 col-6 relative">
                    <a class="product-inner product-inner-small" href="{{ url('/product') }}/{{ $product->id }}">
                        <div class="image relative" style="background:linear-gradient(180deg, rgba(0, 0, 0, 0.00) 60%, rgba(0, 0, 0, 0.4) 100%),url('{{$product->image}}') center / cover;">
                            <span class="name p-bottom-l-10">{{$product->name}}</span>
                            <span class="price">￥<?php echo number_format($product->price); ?></span>
                        </div>
                        <div class="info">
                            <p>
                            <?php
                                $limit=10;
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
                        <a class="manage add" href="{{ url('/product') }}/{{ $product->id }}/stock/{{ $shop->id }}"><i class="fas fa-plus-circle"></i> 在庫に追加</a>
                        <a class="manage" href="{{ url('/product') }}/{{ $product->id }}"><i class="fas fa-info-circle"></i> 詳細</a>
                    </div>
                </div>
            <?php endif; ?>
            @endforeach
            </div>
        </div>
    </div><!-- sec3 -->
    @else
    データベースに登録されている商品がありません
    @endif
</div>
<div class="container">
@endsection
