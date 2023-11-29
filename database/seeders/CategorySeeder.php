<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'name' => 'Coats & Jackets',
                'slug' => 'c_j',
            ],
            [
                'name' => 'Dresses',
                'slug' => 'dresses',
            ],
            [
                'name' => 'Jeans, Trousers & Leggins',
                'slug' => 'jtl',
            ],
            [
                'name' => 'Jumpsuits & Playsuits',
                'slug' => 'js_ps',
            ],
            [
                'name' => 'Shorts',
                'slug' => 'shorts',
            ],
            [
                'name' => 'Skirts',
                'slug' => 'skirts',
            ],
            [
                'name' => 'T-Shirts & Tops',
                'slug' => 'ts_t',
            ],

        ];
        DB::table('categories')->insert($category);
    }
}
