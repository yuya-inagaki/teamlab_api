@extends('layouts.default')

@section('title', '商品一覧')

@section('content')
<a href="{{ url('/product/create') }}">登録</a>
<!-- <a href="{{ url('/products/destroy') }}">削除</a> -->
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
@endsection
