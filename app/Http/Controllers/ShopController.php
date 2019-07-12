<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB; //DBクラスを追加
use Validator;

class ShopController extends Controller
{
    // 店舗一覧表示
    public function index(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/shops";
        $shops = json_decode(file_get_contents($url));
        return view('shop.index', ['shops' => $shops]);
    }

    // 店舗詳細情報表示
    public function show(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/shops/".$request->id;
        $shop = json_decode(file_get_contents($url));
        // $url = "https://app.y-canvas.com/teamlab_api/api/shows/".$shop->id;
        // $products = json_decode(file_get_contents($url));
        $url = "https://app.y-canvas.com/teamlab_api/api/stocks/?shop=".$shop->id;
        $stocks = json_decode(file_get_contents($url));
        $shop_stocks = [];
        foreach ($stocks as $stock){
            $shop_stocks[] = $stock->product_id;
        }
        // $shop_product_list = implode(",", $shop_product_list);
        $url = "https://app.y-canvas.com/teamlab_api/api/products/";
        $products = json_decode(file_get_contents($url));
        return view('shop.show', ['shop' => $shop, 'products' => $products, 'shop_stocks' => $shop_stocks]);
    }

    // 店舗の登録
    public function store(Request $request){
        $rules = [
            'name' => 'required|min:3|max:50', //最低３文字,最大100文字
            'place' => 'required|max:300', //最大300文字
        ];

        $messages = [
            'name.required' => '店舗名は必ず入力してください',
            'name.min' => '店舗名は3文字以上で入力してください',
            'name.max' => '店舗名は50文字以上で入力してください',
            'place.required' => '店舗の場所は必ず入力してください',
            'place.max' => '商品の場所は300文字以内で入力してください',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect('/shop/create/')
                ->withErrors($validator)
                ->withInput();
        }


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

    // 店舗情報の編集画面
    public function edit(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/shops/".$request->id;
        $shop = json_decode(file_get_contents($url));
        return view('shop.edit', ['shop' => $shop]);
    }

    // 店舗情報のアップデート
    public function update(Request $request){
        $rules = [
            'name' => 'required|min:3|max:50', //最低３文字,最大100文字
            'place' => 'required|max:300', //最大300文字
        ];

        $messages = [
            'name.required' => '店舗名は必ず入力してください',
            'name.min' => '店舗名は3文字以上で入力してください',
            'name.max' => '店舗名は50文字以上で入力してください',
            'place.required' => '店舗の場所は必ず入力してください',
            'place.max' => '商品の場所は300文字以内で入力してください',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect('/shop/create/')
                ->withErrors($validator)
                ->withInput();
        }

        $CNL = "\r\n";//改行を変数化
        //POST送信先URL
        $url = 'https://app.y-canvas.com/teamlab_api/api/shops/'.$request->id;
        //テキストデータを記述
        $arrPost = array(
            'name' => $request->name,
            'place' => $request->place,
            '_method' => 'PUT', //PUT
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

    //データベースの削除
    public function destroy(Request $request){
        $url ="https://app.y-canvas.com/teamlab_api/api/shops/".$request->id;

        $options = [
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
        ];

        $curl = curl_init($url);
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);
        return redirect('/shop');
    }

}
