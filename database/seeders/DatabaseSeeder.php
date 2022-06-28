<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(RoleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(DiscountSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
