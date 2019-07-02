@extends('layouts.default')

@section('title', 'ショップごとの表示テスト')

@section('content')
<a href="{{ url('/products/create') }}">登録</a>

@foreach ($shops as $shop)
<p>店名: {{ $shop->shop_name }}</p>
<?php $products = $shop->products ?>

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
            <a class="manage" href="{{ url('/products/destroy') }}/{{ $product->id }}"><i class="far fa-trash-alt"></i> 削除</a>
            <a class="manage" href="{{ url('/products/edit') }}/{{ $product->id }}"><i class="far fa-edit"></i> 編集</a>
        </div>
    </div>

</div>
@endforeach
</div>


@endforeach

@endsection
