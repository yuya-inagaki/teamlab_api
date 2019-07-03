<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stock; //Stockモデルを使用
use App\Shop; //Shopモデルを使用
use App\Product; //プロダクトモデルを使用
use Storage; //ストレージ処理（削除時）に使用

class ApiStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($shop_id = $request->input('shop')){ //shopが保有している商品IDの一覧を返す
            $stocks = Stock::where('shop_id',$shop_id)->get();
            return $stocks;
        }else if($product_id = $request->input('product')){ //該当製品を扱う店舗の一覧を返す
            $stocks = Stock::where('product_id',$product_id)->get();
            return $stocks;
        }else{
            $stocks = Stock::all();
            return $stocks->toArray();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop_id = $request->shop_id;
        $product_id = $request->product_id;

        $query = Stock::query();
        $query->where('shop_id',$shop_id);
        $query->where('product_id',$product_id);
        $stock = $query->get();
        if(count($stock)!=0){
            $stock[0]->delete();
            return $stock->toArray();
        }else{
            $stock = new Stock();
            $stock->shop_id = $request->shop_id;
            $stock->product_id = $request->product_id;
            $stock->save();
            return $stock->toArray();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //ショップのIDを入力したらそのショップが管理する商品の一覧を返す
    {
        $stocks = Stock::where('shop_id',$id)->get();
        if(count($stocks)!=0){
            $data = [];
            foreach($stocks as $stock){
                $data[] = $stock->product_id;
            }
            $products = Product::whereIn('id',$data)->get();
            return $products;
        }else{
            $errors = [
                'database' => 'stocks',
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
