<?php

use Database\Seeders\PostSeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(PostSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
