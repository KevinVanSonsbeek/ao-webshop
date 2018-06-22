<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            ['user_id' => 1, 'order_description' => 'Test description'],
            ['user_id' => 1, 'order_description' => 'Test description2'],
            ['user_id' => 2, 'order_description' => 'Test description3'],
            ['user_id' => 3, 'order_description' => 'Test description4'],
        ]);
    }
}
