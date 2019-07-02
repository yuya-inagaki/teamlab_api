<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductTableSeeder::class); //Productシーダーファイルの登録
        $this->call(ShopTableSeeder::class); //Shopシーダーファイルの登録
        $this->call(StockTableSeeder::class); //Stockシーダーファイルの登録
    }
}
