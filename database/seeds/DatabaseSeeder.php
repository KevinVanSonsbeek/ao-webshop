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
        // $this->call(UsersTableSeeder::class);
        $this->call([
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            ProductCategoryTableSeeder::class,
            OrderSeeder::class,
            OrderDetailsSeeder::class,
        ]);
    }
}
