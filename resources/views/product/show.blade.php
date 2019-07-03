@extends('layouts.default')

@section('title', '商品詳細')

@section('content')
<div class="product_show">
<div class="image" style="background:url('{{ $product->image }}') center / cover ;"></div>
<p>{{ $product->name }}</p>
<p>{{ $product->description }}</p>
</div>
@endsection
