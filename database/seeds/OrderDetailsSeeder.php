<?php

use Illuminate\Database\Seeder;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 12],
            ['order_id' => 1, 'product_id' => 4, 'quantity' => 21],
            ['order_id' => 2, 'product_id' => 3, 'quantity' => 9],
        ]);
    }
}
