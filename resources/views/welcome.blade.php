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
            <a href="{{ url('/api/products') }}">PRODUCT API</a>
        </div>
        <div class="col-md-4">
            <a href="{{ url('/api/shops') }}">SHOP API</a>
        </div>
        <div class="col-md-4">
            <a href="{{ url('/api/stocks') }}">STOCK API</a>
        </div>
    </div>


</div>
@endsection
