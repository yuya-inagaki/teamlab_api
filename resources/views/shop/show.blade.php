@extends('layouts.default')

@section('title', '店舗詳細')

@section('content')

<p>{{ $shop->name }}</p>
<p>{{ $shop->place }}</p>
<a href="{{ url('/shop') }}/{{ $shop->id }}/edit">店舗情報編集</a>

@if( $products != 'none' )
<div class="row">
@foreach ($products as $product)
<div class="col-md-4">
    <div class="product-inner">
        <div class="image relative" style="background:linear-gradient(180deg, rgba(0, 0, 0, 0.00) 60%, rgba(0, 0, 0, 0.4) 100%),url('{{$product->image}}') center / cover;">
            <span class="name p-bottom-l-10">{{$product->name}}</span>
        </div>
        <div class="info">
            <p>id: {{$product->id}}</p>
            <p>description: {{$product->description}}</p>
            <p>price: {{$product->price}} 円</p>
            <a class="manage" href="{{ url('/product') }}/{{ $product->id }}/destroy"><i class="far fa-trash-alt"></i> 削除</a>
            <a class="manage" href="{{ url('/product') }}/{{ $product->id }}/edit"><i class="far fa-edit"></i> 編集</a>
            <a class="manage" href="{{ url('/product') }}/{{ $product->id }}"><i class="far fa-edit"></i> 詳細</a>
        </div>
    </div>
</div>
@endforeach
</div>
@else
商品なし
@endif

@endsection
