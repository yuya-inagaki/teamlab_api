@extends('layouts.default')

@section('title', 'データベースの表示テスト')

@section('content')
<a href="../products/store">登録</a>
<a href="../products/destroy">削除</a>
<table>
<tr><td>id</td><td>商品名</td><td>説明</td><td>金額</td><td>画像</td><td>削除</td></tr>
@foreach ($items as $item)
<tr>
    <td>{{$item->id}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->description}}</td>
    <td>{{$item->price}} 円</td>
    <td><img src="{{$item->image}}" width="200px"></td>
    <td><a href="./products/destroy/{{$item->id}}">削除</a></td>
</tr>
@endforeach
</table>
@endsection
