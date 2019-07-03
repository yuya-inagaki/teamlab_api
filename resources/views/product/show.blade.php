@extends('layouts.default')

@section('title', '商品詳細')

@section('content')
<div class="product_show">
    <div class="image" style="background:url('{{ $product->image }}') center / cover ;"></div>
    <p>{{ $product->name }}</p>
    <p>{{ $product->price }}円</p>
    <p>{{ $product->description }}</p>

    <h2>取扱店舗一覧</h2>
    @if( $shops != 'none' )
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
    @else
    取扱店舗なし
    @endif
</div>
@endsection
