@extends('layouts.default')

@section('title', 'SHOP API')

@section('content')
<div class="all_index">
    <div class-"text-center" style="padding:30px 0;">
        <img src="{{url('/image/logo_black.png')}}" style="max-width:400px; width:80%; margin:0 auto; display:block;">
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ url('/product') }}">
                <div class="content-inner">
                    <div class="image" style="background:url('<?php echo url('/image/product.jpg'); ?>') center / cover;"></div>
                    <div class="info">
                        <p class="title">商品一覧</p>
                        <p>商品の一覧を表示します</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ url('/shop') }}">
                <div class="content-inner">
                    <div class="image" style="background:url('<?php echo url('/image/shop.jpg'); ?>') center / cover;"></div>
                    <div class="info">
                        <p class="title">店舗一覧</p>
                        <p>店舗の一覧を表示します</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ url('/api/products') }}">
                <div class="content-inner">
                    <div class="info">
                        <p class="title">PRODUCT API</p>
                        <p>商品の登録・検索・変更・削除を行うAPI</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ url('/api/shops') }}">
                <div class="content-inner">
                    <div class="info">
                        <p class="title">SHOP API</p>
                        <p>店舗の登録・検索・変更・削除を行うAPI</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ url('/api/stocks') }}">
                <div class="content-inner">
                    <div class="info">
                        <p class="title">STOCK API</p>
                        <p>店舗が管理する商品の登録・削除を行うAPI</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-12">
            <div class="content-inner">
                <div class="info">
                    <p class="title">- ABOUT -</p>
                    <p style="text-align:left;">商品画像・商品タイトル・説明文・価格の４つの情報をもつ商品データの登録・検索・変更・削除を行うRESTfulなAPIの設計と実装を行った。また、作成したAPIを使用して商品登録や検索などが行えるインタフェースの実装を行った。さらに、店舗の概念を追加して店舗ごとに管理している商品を閲覧・管理できる機能を追加実装した。<br><br>2019.07.04 / Yuya Inagaki</p>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
