

@extends('layouts.default')

@section('title', 'データベース登録テスト')

@section('content')
<table>
    <form method="POST" action="https://app.y-canvas.com/teamlab_api/api/products" enctype="multipart/form-data">
        {{ csrf_field() }}
        <tr>
            <th>商品名</th>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <th>説明</th>
            <td><textarea name="description"></textarea></td>
        </tr>
        <tr>
            <th>価格</th>
            <td><input type="text" name="price"></td>
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
