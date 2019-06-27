@extends('layouts.default')

@section('title', 'データベースの表示テスト')

@section('content')
<a href="./store">登録</a>
<a href="./destroy">削除</a>
<div class="row">
@foreach ($products as $product)
<div class="col-md-6">
    <img src="{{$product->image}}" width="100%">
    <p>id: {{$product->id}}</p>
    <p>name: {{$product->name}}</p>
    <p>description: {{$product->description}}</p>
    <p>price: {{$product->price}} 円</p>
    <a href="./destroy/{{$product->id}}">削除</a>
</div>
@endforeach
</div>
@endsection
