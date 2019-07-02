<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product; //プロダクトモデルを使用
use Storage; //ストレージ処理（削除時）に使用

class ApiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //一覧表示（検索）
    {
        $products = Product::all();
        return $products->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Createについて記述';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //登録
    {
        $filepath = 'null';
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $filepath;
        $product->save();

        $nextId = $product->id;
        $filename = $nextId . '_0.jpg';
        $filepath = 'https://app.y-canvas.com/teamlab_api/storage/product_images/'. $filename;
        $request->image->storeAs('public/product_images', $filename);
        $product->image = $filepath;
        $product->save();
        return $product->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //個別閲覧
    {
        if($item = Product::find($id)){
            return $item->toArray();
        }else{
            $errors = [
                'database' => 'products',
                'function' => 'show',
                'message' => 'no data',
                'id' => $id
            ];
            $json =['error' =>$errors];
            return $json;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //変更
    {
        return 'Editについて記述';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //変更
    {
        if($product = Product::find($id)){
            if($request->image){
                $version = $product->update;
                $filename = $id . '_' . $version . '.jpg';
                Storage::disk('local')->delete('public/product_images/'.$filename);
                $version ++ ;
                $product->update = $version; //画像バージョンの変更
                $filename = $id . '_' . $version . '.jpg';
                $filepath = 'https://app.y-canvas.com/teamlab_api/storage/product_images/'. $filename;
                $request->image->storeAs('public/product_images', $filename);
                $product->image = $filepath;
            }
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->save();
            return $product->toArray();
        }else{
            $errors = [
                'function' => 'delete',
                'message' => 'no data',
                'id' => $id
            ];
            $json =['error' =>$errors];
            return $json;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //削除
    {
        if($product = Product::find($id)){
            $filename = $id . '.jpg';
            Storage::disk('local')->delete('public/product_images/'.$filename);
            $product->delete();
        }else{
            $errors = [
                'function' => 'delete',
                'message' => 'no data',
                'id' => $id
            ];
            $json =['error' =>$errors];
            return $json;
        }
    }
}
