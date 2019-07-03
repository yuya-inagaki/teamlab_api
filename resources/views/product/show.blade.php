@extends('layouts.default')

@section('title', '商品詳細')

@section('content')
<div class="product_show">
<div class="image" style="background:url('{{ $product->image }}') center / cover ;"></div>
<p>{{ $product->name }}</p>
<p>{{ $product->description }}</p>
</div>

<div class="row">
@foreach ($shops as $shop)
<div class="col-md-4">
    <div>
        <p>{{ $shop->name }}</p>
        <p>{{ $shop->place }}</p>
        <a href="{{ url('/shop') }}/{{ $shop->id }}">店舗の詳細</a>
    </div>
</div>
@endforeach
</div>

@endsection
