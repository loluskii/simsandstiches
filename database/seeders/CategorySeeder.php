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
                'name' => 'Kimonos',
                'slug' => 'kimonos',
            ],
            [
                'name' => 'Kaftans',
                'slug' => 'kaftans',
            ],
        ];
        DB::table('categories')->insert($category);
    }
}
