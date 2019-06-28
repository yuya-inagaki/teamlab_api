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
        $products = json_decode(file_get_contents($url));
        dd($products);
        $header = array(
            'Content-Type: application/x-www-form-urlencoded',
        );
        $options = array(
            'http' => array(
                'method' => 'get',
                'header' => implode("\n", $header), // リクエストヘッダを改行コード区切りで設定
                'ignore_errors' => true, // これ入れないと400・500番台のHTTPステータスコードが帰ってきた場合にwarning吐く
            )
        );
        $contents = file_get_contents($url, false, stream_context_create($options));
        return var_dump($contents);
        // if(isset($request->id)){
        //     $params = ['id' => $request->id];
        //     return view('home.destroy', $params);
        // }else{
        //     $params = ['id' => 0];
        //     return view('home.destroy', $params);
        // }
    }

    //データベースの登録
    public function create(Request $request){
        $url ="https://app.y-canvas.com/teamlab_api/api/products";
        $data = array(
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image
        );
        // HTTPヘッダの内容(※ここがかなり重要っぽい)
        $header = array(
            "Content-Type: application/x-www-form-urlencoded"
        );
        $content = http_build_query($data);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => implode("\r\n", $header),
                'content' => $content
            )
        );
        $contents = file_get_contents($url, false, stream_context_create($options));
        return $contents;
    }

    // //データベースの登録
    // public function database_register(Request $request){
    //     $params = [
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'price' => $request->price,
    //     ];
    //     DB::insert('insert into products (name, description, price) values (:name, :description, :price)', $params);
    //     return redirect('/home/database');
    // }

}
