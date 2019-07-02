<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //DBクラス使用のため追加

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params =[
            'shop_id' => 1,
            'product_id' => 1,
        ];
        DB::table('stocks')->insert($params);

        $params =[
            'shop_id' => 2,
            'product_id' => 2,
        ];
        DB::table('stocks')->insert($params);

        $params =[
            'shop_id' => 3,
            'product_id' => 3,
        ];
        DB::table('stocks')->insert($params);
    }
}
