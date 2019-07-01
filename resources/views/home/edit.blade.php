@extends('layouts.default')

@section('title', '編集')

@section('content')
<table>
    <form method="POST" action="{{ url('/products/update') }}/{{ $product->id }}" enctype="multipart/form-data">
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
            <td><img src="{{ $product->image }}" width="100px"><input type="file" name="image"></td>
        </tr>
        <!-- <input type="hidden" name="_method" value="PUT">-->
        <tr>
            <th></th>
            <td><input type="submit" value="送信"></td>
        </tr>
    </form>
</table>
@endsection
