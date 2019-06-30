

@extends('layouts.default')

@section('title', 'データベース登録テスト')

@section('content')
<table>
    <form method="POST" action="{{ url('/products') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if($errors->has('name'))
        {{ $errors->first('name') }}
        @endif
        @if($errors->has('description'))
        {{ $errors->first('description') }}
        @endif
        @if($errors->has('price'))
        {{ $errors->first('price') }}
        @endif
        @if($errors->has('image'))
        {{ $errors->first('image') }}
        @endif
        <tr>
            <th>商品名</th>
            <td><input type="text" name="name" value="{{ old('name') }}"></td>
        </tr>
        <tr>
            <th>説明</th>
            <td><textarea name="description">{{ old('description') }}</textarea></td>
        </tr>
        <tr>
            <th>価格</th>
            <td><input type="text" name="price" value="{{ old('price') }}"></td>
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
