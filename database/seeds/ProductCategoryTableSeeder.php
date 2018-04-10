<?php

use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_category')->insert([
            ['product_id' => '1', 'category_id' => '1'],
            ['product_id' => '2', 'category_id' => '2'],
            ['product_id' => '3', 'category_id' => '3'],
            ['product_id' => '4', 'category_id' => '4'],
            ['product_id' => '5', 'category_id' => '5'],
        ]);
    }
}
