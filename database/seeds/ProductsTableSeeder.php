<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['name' => 'SurvivalSchep', 'description' => 'Een schep!', 'price' => '49.99'],
            ['name' => 'Duplo', 'description' => 'Een giga duplo pakket', 'price' => '215'],
            ['name' => 'Moederbord', 'description' => 'Een printplaat dinges!', 'price' => '199.99'],
            ['name' => 'Plantenbakken', 'description' => 'Handige plantenbakken!', 'price' => '49.99'],
            ['name' => 'Stofzuiger', 'description' => 'Een zuiger!', 'price' => '85.99'],
        ]);
    }
}
