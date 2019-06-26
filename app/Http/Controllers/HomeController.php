<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB; //DBクラスを追加


class HomeController extends Controller
{
    public function show(Request $request){
        // $url = "https://y-canvas.com/api/check1.php?num=30";
        // $datas = json_decode(file_get_contents($url));
        // // dd($datas);
        // return $datas->status.' '.$datas->x114.' '.$datas->x514;
        if(isset($request->id)){
            $params = ['id' => $request->id];
            $items = DB::select('select * from products where id = :id', $params);
        }else{
            $items = DB::select('select * from products');
        }
        return view('home.show', ['items' => $items]);
    }

    //データベースの削除
    public function destroy(Request $request){
        if(isset($request->id)){
            $params = ['id' => $request->id];
            return view('home.destroy', $params);
        }else{
            $params = ['id' => 0];
            return view('home.destroy', $params);
        }
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
