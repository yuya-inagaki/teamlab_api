@extends('layouts.default')

@section('title', '店舗一覧')

@section('content')
<a href="{{ url('/shop/create') }}">登録</a>
<!-- <a href="{{ url('/products/destroy') }}">削除</a> -->
<div class="row">
@foreach ($shops as $shop)
<div class="col-md-4">
    <div>
        <p>{{ $shop->name }}</p>
        <p>{{ $shop->place }}</p>
    </div>
</div>
@endforeach
</div>
@endsection
