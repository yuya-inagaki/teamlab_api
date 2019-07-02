<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //DBクラス使用のため追加

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params =[
            'name' => '高田馬場店',
            'place' => '〒169-0075 東京都新宿区高田馬場１丁目３５−２',
        ];
        DB::table('shops')->insert($params);

        $params =[
            'name' => '新宿店',
            'place' => '〒160-0022 東京都新宿区新宿３丁目',
        ];
        DB::table('shops')->insert($params);

        $params =[
            'name' => '東京店',
            'place' => ' 東京都千代田区丸の内１丁目',
        ];
        DB::table('shops')->insert($params);
    }
}
