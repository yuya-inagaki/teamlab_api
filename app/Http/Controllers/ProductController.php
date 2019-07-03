<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB; //DBクラスを追加


class ProductController extends Controller
{
    public function index(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/products";
        $products = json_decode(file_get_contents($url));
        return view('product.index', ['products' => $products]);
    }

    public function show(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/products/".$request->id;
        $product = json_decode(file_get_contents($url));
        return view('product.show', ['product' => $product]);
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
        return redirect('/products');
    }

    //アップデート
    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required|min:3|max:100', //最低３文字,最大100文字
            'description' => 'required|max:500', //最大500文字
            'price' => 'required|digits_between:1,10', //1から10桁までの数字
            'image' => 'image|max:3000', //3000kb(3MB)以下のファイル
        ]);

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

        $this->validate($request,[
            'name' => 'required|min:3|max:100', //最低３文字,最大100文字
            'description' => 'required|max:500', //最大500文字
            'price' => 'required|digits_between:1,10', //1から10桁までの数字
            'image' => 'required|image|max:3000', //3000kb(3MB)以下のファイル
        ]);


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
