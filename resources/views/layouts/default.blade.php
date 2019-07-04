<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="{{ url('/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script>
      (function(d) {
        var config = {
          kitId: 'ccq4pnt',
          scriptTimeout: 3000,
          async: true
        },
        h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
      })(document);
    </script>

</head>
<body>
    <header>
        <div class="menu-pc">
            <div class="container">
                <a class="menu-inner logo" href="{{ url('') }}">
                    <img src="{{ url('/image/logo_black.png') }}" width="150px">
                </a>
                @if ($__env->yieldContent('title') == '商品一覧')
                <a class="menu-inner select" href="{{ url('/product') }}">
                @else
                <a class="menu-inner" href="{{ url('/product') }}">
                @endif
                    <div><i class="fas fa-shopping-cart"></i><br><span>商品一覧</span></div>
                </a>

                @if ($__env->yieldContent('title') == '店舗一覧')
                <a class="menu-inner select" href="{{ url('/shop') }}">
                @else
                <a class="menu-inner" href="{{ url('/shop') }}">
                @endif
                    <div><i class="fas fa-store"></i><br><span>店舗一覧</span></div>
                </a>

                @if ($__env->yieldContent('title') == '商品登録')
                <a class="menu-inner select" href="{{ url('/product/create') }}">
                @else
                <a class="menu-inner" href="{{ url('/product/create') }}">
                @endif
                    <div><i class="fas fa-cloud-upload-alt"></i><br><span>商品登録</span></div>
                </a>

                @if ($__env->yieldContent('title') == '店舗登録')
                <a class="menu-inner select" href="{{ url('/shop/create') }}">
                @else
                <a class="menu-inner" href="{{ url('/shop/create') }}">
                @endif
                    <div><i class="fas fa-cloud-upload-alt"></i><br><span>店舗登録</span></div>
                </a>
            </div>
        </div>
        <div class="menu-sm">
            <a class="logo" href="{{ url('') }}">
                <img src="{{ url('/image/logo_black.png') }}">
            </a>
            <!-- ハンバーガーメニュー -->
            <a class="menu-trigger" href="#">
              <span></span>
              <span></span>
              <span></span>
            </a>
            <!-- //ハンバーガーメニュー -->
            <div class="menu mobile_menu">
                @if ($__env->yieldContent('title') == '商品一覧')
                <a class="menu-inner select" href="{{ url('/product') }}">
                @else
                <a class="menu-inner" href="{{ url('/product') }}">
                @endif
                    <i class="fas fa-shopping-cart"></i> <span>商品一覧</span>
                </a>

                @if ($__env->yieldContent('title') == '店舗一覧')
                <a class="menu-inner select" href="{{ url('/shop') }}">
                @else
                <a class="menu-inner" href="{{ url('/shop') }}">
                @endif
                    <i class="fas fa-store fa-fw"></i> <span>店舗一覧</span>
                </a>

                @if ($__env->yieldContent('title') == '商品登録')
                <a class="menu-inner select" href="{{ url('/product/create') }}">
                @else
                <a class="menu-inner" href="{{ url('/product/create') }}">
                @endif
                    <i class="fas fa-cloud-upload-alt fa-fw"></i> <span>商品登録</span>
                </a>

                @if ($__env->yieldContent('title') == '店舗登録')
                <a class="menu-inner select" href="{{ url('/shop/create') }}">
                @else
                <a class="menu-inner" href="{{ url('/shop/create') }}">
                @endif
                    <i class="fas fa-cloud-upload-alt fa-fw"></i> <span>店舗登録</span>
                </a>
            </div>
        </div>
    </header>
    <div class="header-sapce"></div>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>


<script type="text/javascript">
$('.menu-trigger').on('click', function() { //ハンバーガーメニュー
    $(this).toggleClass('active');
    if ($('.mobile_menu').is(':hidden')) $('.mobile_menu').slideDown();
    else $('.mobile_menu').slideUp();
    return false;
});
$('.delete-trigger').on('click', function() { //削除確認用
    $(this).toggleClass('active');
    $('.delete-check').slideDown();
    return false;
});
$('.delete-check-close').on('click', function() { //削除確認用
    $('.delete-trigger').toggleClass('active');
    $('.delete-check').slideUp();
    return false;
});
</script>
