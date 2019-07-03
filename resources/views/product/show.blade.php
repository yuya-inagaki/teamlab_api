@extends('layouts.default')

@section('title', '商品詳細')

@section('content')

<img src="{{ $product->image }}" width="100%">
<p>{{ $product->name }}</p>
<p>{{ $product->description }}</p>

@endsection
