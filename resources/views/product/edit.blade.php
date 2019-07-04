@extends('layouts.default')

@section('title', '編集')

@section('content')

<div class="form">
    <form method="POST" action="{{ url('/product') }}/{{ $product->id }}/update" enctype="multipart/form-data">
        {{ csrf_field() }}

        <p>商品名</p>
        @if($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
        @endif
        <input type="text" name="name" value="{{ $product->name }}">
        <p>説明</p>
        @if($errors->has('description'))
        <span class="error">{{ $errors->first('description') }}</span>
        @endif
        <textarea name="description">{{ $product->description }}</textarea>
        <p>価格</p>
        @if($errors->has('price'))
        <span class="error">{{ $errors->first('price') }}</span>
        @endif
        <input type="number" name="price" value="{{ $product->price }}">
        <p>画像(最大3MB)</p>
        @if($errors->has('image'))
        <span class="error">{{ $errors->first('image') }}</span>
        @endif
        <img src="{{ $product->image }}" width="200px">
        <p style="font-size:10px; margin:0;">*画像を変更するには新しい画像を選択して下さい、変更の必要がない場合はそのままで問題ありません</p>
        <input type="file" name="image">
        <input class="submit" type="submit" value="修正する">
    </form>
</div>
@endsection
