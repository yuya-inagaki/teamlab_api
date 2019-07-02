

@extends('layouts.default')

@section('title', '店舗登録')

@section('content')
<div class="form">
    <form method="POST" action="{{ url('/shop') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <p>店舗名</p>
        @if($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
        @endif
        <input type="text" name="name" placeholder="商品名" value="{{ old('name') }}">
        <p>住所</p>
        @if($errors->has('place'))
        <span class="error">{{ $errors->first('place') }}</span>
        @endif
        <input type="text" name="place" placeholder="住所" value="{{ old('place') }}">
        <input type="submit" value="送信">
    </form>
</div>
@endsection
