<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB; //DBクラスを追加
use Validator;


class ProductController extends Controller
{
    public function index(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/products";
        $products = json_decode(file_get_contents($url));
        return view('product.index', ['products' => $products, 'search' => false]);
    }

    public function search(Request $request){
        $this->validate($request,[
            'name' => 'required',
        ]);
        $url = "https://app.y-canvas.com/teamlab_api/api/products?name=".urlencode($request->name);
        $products = json_decode(file_get_contents($url));
        return view('product.index', ['products' => $products, 'search' => $request->name]);
    }

    public function show(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/products/".$request->id;
        $product = json_decode(file_get_contents($url));

        $url = "https://app.y-canvas.com/teamlab_api/api/stocks/?product=".$product->id;
        $stocks = json_decode(file_get_contents($url));
        $shops_id = [];
        foreach ($stocks as $stock){
            $shops_id[] = $stock->shop_id;
        }
        if(count($shops_id)!=0){
            $shops_id = implode(",", $shops_id);
            $url = "https://app.y-canvas.com/teamlab_api/api/shops/?id=".$shops_id;
            $shops = json_decode(file_get_contents($url));
        }else{
            $shops = 'none';
        }
        return view('product.show', ['product' => $product, 'shops' => $shops]);
    }

    public function stock_operation(Request $request){
        $product_id = $request->product_id;
        $shop_id = $request->shop_id;

        $CNL = "\r\n";//改行を変数化
        //POST送信先URL
        $url = 'https://app.y-canvas.com/teamlab_api/api/stocks';
        //テキストデータを記述
        $arrPost = array(
            'product_id' => $product_id,
            'shop_id' => $shop_id,
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
        return redirect('/shop/'.$shop_id);
    }

    public function show_shop(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/shows";
        $shops = json_decode(file_get_contents($url));
        return view('product.show_shop', ['shops' => $shops]);
    }

    //データベースの削除
    public function destroy(Request $request){
        $url ="https://app.y-canvas.com/teamlab_api/api/products/".$request->id;

        $options = [
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
        ];

        $curl = curl_init($url);
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);
        return redirect('/product');
    }

    //アップデート
    public function update(Request $request){
        $rules = [
            'name' => 'required|min:3|max:100', //最低３文字,最大100文字
            'description' => 'required|max:500', //最大500文字
            'price' => 'required|digits_between:1,10', //1から10桁までの数字
        ];

        $messages = [
            'name.required' => '商品名は必ず入力してください',
            'name.min' => '商品名は3文字以上で入力してください',
            'name.max' => '商品名は100文字以上で入力してください',
            'description.required' => '商品の説明は必ず入力してください',
            'description.max' => '商品の説明は500文字以内で入力してください',
            'price.required' => '商品の価格は必ず入力してください',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect('/product/'.$request->id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $CNL = "\r\n";//改行を変数化

        //POST送信先URL
        $url = 'https://app.y-canvas.com/teamlab_api/api/products/'.$request->id;

        //テキストデータを記述
        $arrPost = array(
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            '_method' => 'PUT', //PUT
        );

        //画像ファイルパスを記述
        $filePath = $_FILES['image']['tmp_name'];

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

        if(file_exists($filePath)){

            $imageFile = file_get_contents($filePath); //ファイルの内容の取得

            $key = 'image';
            $arrContent[] = 'Content-Disposition: form-data; name="'.$key.'"; filename="'.basename($filePath).'"';
            $arrContent[] = 'Content-Type: image/jpeg';
            $arrContent[] = $CNL.$imageFile; //画像ファイルデータを挿入
            $arrContent[] = '--'.$boundary;
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

        return redirect('/product');


    }


    //データベースの登録
    public function store(Request $request){

        $rules = [
            'name' => 'required|min:3|max:100', //最低３文字,最大100文字
            'description' => 'required|max:500', //最大500文字
            'price' => 'required|digits_between:1,10', //1から10桁までの数字
            'image' => 'required|image|max:3000', //3000kb(3MB)以下のファイル
        ];

        $messages = [
            'name.required' => '商品名は必ず入力してください',
            'name.min' => '商品名は3文字以上で入力してください',
            'name.max' => '商品名は100文字以上で入力してください',
            'description.required' => '商品の説明は必ず入力してください',
            'description.max' => '商品の説明は500文字以内で入力してください',
            'price.required' => '商品の価格は必ず入力してください',
            'image.required' => '商品の画像は必ず選択してください',
            'image.max' => '画像サイズが大きすぎます（3MB以内）',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect('/product/create')
                ->withErrors($validator)
                ->withInput();
        }

        $CNL = "\r\n";//改行を変数化

        //POST送信先URL
        $url = 'https://app.y-canvas.com/teamlab_api/api/products';

        //テキストデータを記述
        $arrPost = array(
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        );

        //画像ファイルパスを記述
        $filePath = $_FILES['image']['tmp_name'];

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

        if(file_exists($filePath)){

            $imageFile = file_get_contents($filePath); //ファイルの内容の取得

            $key = 'image';
            $arrContent[] = 'Content-Disposition: form-data; name="'.$key.'"; filename="'.basename($filePath).'"';
            $arrContent[] = 'Content-Type: image/jpeg';
            $arrContent[] = $CNL.$imageFile; //画像ファイルデータを挿入
            $arrContent[] = '--'.$boundary;
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

        return redirect('/product');

    }


    public function edit(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/products/".$request->id;
        $product = json_decode(file_get_contents($url));
        return view('product.edit', ['product' => $product]);
    }

}
