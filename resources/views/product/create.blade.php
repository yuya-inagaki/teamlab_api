

@extends('layouts.default')

@section('title', '商品登録')

@section('content')
<div class="form">
    <form method="POST" action="{{ url('/product') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <p>商品名</p>
        @if($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
        @endif
        <input type="text" name="name" placeholder="商品名" value="{{ old('name') }}">
        <p>説明</p>
        @if($errors->has('description'))
        <span class="error">{{ $errors->first('description') }}</span>
        @endif
        <textarea name="description">{{ old('description') }}</textarea>
        <p>価格</p>
        @if($errors->has('price'))
        <span class="error">{{ $errors->first('price') }}</span>
        @endif
        <input type="number" name="price" placeholder="100" value="{{ old('price') }}">
        <p>画像(最大3MB)</p>
        @if($errors->has('image'))
        <span class="error">{{ $errors->first('image') }}</span>
        @endif
        <input type="file" name="image">
        <input class="submit" type="submit" value="商品を登録する">
    </form>
</div>
@endsection
