<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB; //DBクラスを追加

class ShopController extends Controller
{
    // 店舗一覧表示
    public function index(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/shops";
        $shops = json_decode(file_get_contents($url));
        return view('shop.index', ['shops' => $shops]);
    }

    public function show(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/shops/".$request->id;
        $shop = json_decode(file_get_contents($url));
        $url = "https://app.y-canvas.com/teamlab_api/api/shows/".$shop->id;;
        $products = json_decode(file_get_contents($url));
        dd($products);
        return view('shop.show', ['shop' => $shop, 'products' => $products]);
    }

    // 店舗の登録
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|min:3|max:50', //最低３文字,最大100文字
            'place' => 'required|max:300', //最大300文字
        ]);
        $CNL = "\r\n";//改行を変数化
        //POST送信先URL
        $url = 'https://app.y-canvas.com/teamlab_api/api/shops';
        //テキストデータを記述
        $arrPost = array(
            'name' => $request->name,
            'place' => $request->place,
        );
        $arrContent = [];
        $boundary = "----1234567890";
        //ペイロード作成
        $arrContent[] = $CNL.'--'.$boundary;//開始
        if(count($arrPost) > 0){
            foreach($arrPost as $key => $val) {
                $arrContent[] = 'Content-Disposition: form-data; name="'.$key.'"'.$CNL;
                $arrContent[] = $val;
                $arrContent[] = '--'.$boundary;
            }
        }
        $content = join($CNL, $arrContent);
        $content .= '--'.$CNL;//終端
        $header = join($CNL,array(
            "Content-Type: multipart/form-data; boundary=".$boundary,
            "Content-Length: ".strlen($content)
        ));
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => $header,
                'content' => $content
            )
        ));
        $contents = file_get_contents($url, false, $context);
        return redirect('/shop');
    }

}
