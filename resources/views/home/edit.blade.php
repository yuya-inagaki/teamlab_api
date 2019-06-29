@extends('layouts.default')

@section('title', '編集')

@section('content')
<table>
    <form method="POST" action="{{ url('/products') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <tr>
            <th>商品名</th>
            <td><input type="text" name="name" value="{{ $product->name }}"></td>
        </tr>
        <tr>
            <th>説明</th>
            <td><textarea name="description">{{ $product->description }}</textarea></td>
        </tr>
        <tr>
            <th>価格</th>
            <td><input type="text" name="price" value="{{ $product->price }}"></td>
        </tr>
        <tr>
            <th>画像</th>
            <td><input type="file" name="image"></td>
        </tr>
        <tr>
            <th></th>
            <td><input type="submit" value="送信"></td>
        </tr>
    </form>
</table>
@endsection
