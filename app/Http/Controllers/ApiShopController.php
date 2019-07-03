<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Shop; //Shopモデルを使用
use Storage; //ストレージ処理（削除時）に使用

class ApiShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($ids = $request->input('id')){ //idによる検索
            $ids = explode(',', $ids);
            $shops = Shop::whereIn('id',$ids)->get();
            return $shops;
        }else{
            $shops = Shop::all();
            return $shops->toArray();
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
        $shop = new Shop();
        $shop->name = $request->name;
        $shop->place = $request->place;
        $shop->save();
        return $shop->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($shop = Shop::find($id)){
            return $shop->toArray();
        }else{
            $errors = [
                'database' => 'shops',
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
        if($shop = Shop::find($id)){
            $shop->name = $request->name;
            $shop->place = $request->place;
            $shop->save();
            return $shop->toArray();
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
    public function destroy($id)
    {
        //
    }
}
