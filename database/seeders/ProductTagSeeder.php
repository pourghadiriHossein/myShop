<?php

namespace Database\Seeders;

use App\Models\ProductTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productTags = [
            ['label' => 'مجلسی'],
            ['label' => 'اسپرت'],
            ['label' => 'راحتی'],
            ['label' => 'مقاوم'],
        ];

        ProductTag::insert($productTags);
    }
}
