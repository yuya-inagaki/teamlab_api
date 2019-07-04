@extends('layouts.default')

@section('title', '商品詳細')

@section('content')
<div class="product_show">

    <p class="name">{{ $product->name }}</p>
    <div class="image" style="background:url('{{ $product->image }}') center / cover ;"></div>
    <p class="price">￥<?php echo number_format($product->price); ?></p>
    <p>{{ $product->description }}</p>
    <a class="btn-link" href="{{url('/product')}}/{{$product->id}}/edit"><i class="far fa-edit"></i> 編集する</a>
    <a class="btn-link delete-trigger"><i class="fas fa-minus"></i> 削除する</a>
    <div class="delete-check">
        <p style="color:red;">本当に{{ $product->name }}を削除しますか？削除するとこの商品の取扱店舗の在庫からも削除されます。</p>
        <a class="btn-link red" href="{{url('/product')}}/{{$product->id}}/destroy"><i class="far fa-thumbs-up"></i> はい</a>
        <a class="btn-link blue delete-check-close"><i class="far fa-times-circle"></i> いいえ</a>
    </div>
    <div><h2>取扱店舗一覧</h2></div>
    @if( $shops != 'none' )
        <table class="shoplist">
            <tr>
                <th>店舗名</th><th>場所</th><th>店舗詳細</th>
            </tr>
            @foreach ($shops as $shop)
            <tr>
                <td>{{ $shop->name }}</td>
                <td>{{ $shop->place }}</td>
                <td><a href="{{ url('/shop') }}/{{ $shop->id }}">店舗の詳細</td>
            </tr>
            @endforeach
        </table>
    @else
    取扱店舗なし
    @endif
</div>
@endsection
