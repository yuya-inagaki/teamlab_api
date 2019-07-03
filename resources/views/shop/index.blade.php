@extends('layouts.default')

@section('title', '店舗一覧')

@section('content')
<div class="shop_index">
    <h1><i class="fas fa-store fa-fw"></i> 店舗一覧</h1>
    <table class="shoplist">
    <tr>
        <th>店舗名</th><th>場所</th><th>店舗詳細</th>
    </tr>
    @foreach ($shops as $shop)
    <tr>
        <td>{{ $shop->name }}</td>
        <td>{{ $shop->place }}</td>
        <td><a href="{{ url('/shop') }}/{{ $shop->id }}">店舗の詳細</td>
    </tr>
    @endforeach
    </table>
</div>
@endsection
