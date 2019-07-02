<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stock; //Stockモデルを使用
use App\Shop; //Shopモデルを使用
use App\Product; //プロダクトモデルを使用
use Storage; //ストレージ処理（削除時）に使用

class ApiShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $output = [];
        $shops = Shop::all();
        foreach($shops as $shop){
            // echo $shop->id. ' ' .$shop->name. ' ' .$shop->place.'<br>';

            $stocks = Stock::where('shop_id',$shop->id)->get();
            if(count($stocks)!=0){
                $data = [];
                foreach($stocks as $stock){
                    $data[] = $stock->product_id;
                }
                $products = Product::whereIn('id',$data)->get();
            }else{
                $products = ('none');
            }

            $shop_data = array(
                'shop_id' => $shop->id,
                'shop_name' => $shop->name,
                'shop_place' => $shop->place,
                'products' => $products
            );

            array_push($output,$shop_data);
        }
        return $output;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stocks = Stock::where('shop_id',$id)->get();
        if(count($stocks)!=0){
            $data = [];
            foreach($stocks as $stock){
                $data[] = $stock->product_id;
            }
            $products = Product::whereIn('id',$data)->get();
            $json =['data' => $products];
            return $json;
        }else{
            $json =['data' => 'none'];
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
