<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB; //DBクラスを追加


class HomeController extends Controller
{
    public function show(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/products";
        $products = json_decode(file_get_contents($url));
        //
        // if(isset($request->id)){
        //     $params = ['id' => $request->id];
        //     $products = DB::select('select * from products where id = :id', $params);
        // }else{
        //     $products = DB::select('select * from products');
        // }
        return view('home.show', ['products' => $products]);
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

        return redirect('/products');


    }

    //データベースの登録
    public function store(Request $request){
        // $url = "https://app.y-canvas.com/teamlab_api/api/products/";
        // $data = array(
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'price' => $request->price,
        //     // 'image' => new \CURLFile($_FILES["image"]["tmp_name"],'image/jpeg','test_name')
        // );
        //
        // $header = [
        //     'Content-Type: application/json',
        // ];
        //
        // $curl = curl_init($url);
        // $options = [
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => json_encode($data), // jsonデータを送信
        //     CURLOPT_HTTPHEADER => $header, // リクエストにヘッダーを含める
        //     CURLOPT_SSL_VERIFYPEER => false,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_RETURNTRANSFER => true,
        // ];
        // // dd($options);
        //
        // curl_setopt_array($curl, $options);
        // $response = curl_exec($curl);
        // // dd($response);
        // curl_close($curl);
        // return redirect('/products');


        // $url = "https://app.y-canvas.com/teamlab_api/api/products";
        //
        // // 画像に関する処理
        // $filePath = $_FILES['image']['tmp_name'];
        // $fileName = basename($filePath);
        // $file = file_get_contents($filePath); //ファイルの内容の取得
        //
        // $data = array(
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'price' => $request->price,
        //     'image' => array(
        //         'file_name' => $fileName,
        //         'Content-Type' => 'image/jpeg',
        //         $file
        //     )
        // );
        // // HTTPヘッダの内容(※ここがかなり重要っぽい)
        // $header = array(
        //     'Content-Type: application/x-www-form-urlencoded',
        // );
        // $content = http_build_query($data);
        // $options = array(
        //     'http' => array(
        //         'method' => 'POST',
        //         'header' => implode("\r\n", $header),
        //         'content' => $content
        //     )
        // );
        // // dd($options);
        // $contents = file_get_contents($url, false, stream_context_create($options));
        // return $contents;

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

        return redirect('/products');

    }

    public function edit(Request $request){
        $url = "https://app.y-canvas.com/teamlab_api/api/products/".$request->id;
        $product = json_decode(file_get_contents($url));
        return view('home.edit', ['product' => $product]);
    }

}
