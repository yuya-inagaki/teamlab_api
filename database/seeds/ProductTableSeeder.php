<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //DBクラス使用のため追加

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params =[
            'name' => 'iPad Pro',
            'description' => 'Appleが発売しているタブレット端末',
            'price' => 80000,
            'image' => 'https://y-canvas.com/file/images/test1.jpg',
        ];
        DB::table('products')->insert($params);

        $params =[
            'name' => 'レッドブル',
            'description' => 'エナジードリンク',
            'price' => 210,
            'image' => 'https://y-canvas.com/file/images/test2.jpg',
        ];
        DB::table('products')->insert($params);

        $params =[
            'name' => '天然水グリンティー',
            'description' => 'サントリーの天然水と国産茶葉の軽やかな緑茶です。',
            'price' => 150,
            'image' => 'https://y-canvas.com/file/images/test3.jpg',
        ];
        DB::table('products')->insert($params);
    }
}
