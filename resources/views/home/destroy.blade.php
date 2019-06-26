@extends('layouts.default')

@section('title', 'データベース削除テスト')

@section('content')
<h1>削除：{{$id}}</h1>
<form method="post" action="/api/products/{{$id}}">
    {{ csrf_field() }}
    <p>商品ID</p>
    <input name="_method" type="hidden" value="DELETE">
    <input type="submit" value="送信">
</form>
@endsection
