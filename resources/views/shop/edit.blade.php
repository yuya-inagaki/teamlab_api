@extends('layouts.default')

@section('title', '編集')

@section('content')

<div class="form">
    <form method="POST" action="{{ url('/shop') }}/{{ $shop->id }}/update" enctype="multipart/form-data">
        {{ csrf_field() }}

        <p>店舗名</p>
        @if($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
        @endif
        <input type="text" name="name" value="{{ $shop->name }}">
        <p>住所</p>
        @if($errors->has('place'))
        <span class="error">{{ $errors->first('place') }}</span>
        @endif
        <input type="text" name="place" value="{{ $shop->place }}">

        <input type="submit" value="送信">
    </form>
</div>
@endsection
