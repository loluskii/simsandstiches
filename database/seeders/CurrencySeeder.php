<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'Nigerian Naira',
            'symbol' => '₦',
            'exchange_rate' => 1,
            'code' => 'NGN',
            'icon' => '🇳🇬',
            'is_default' => 1,
        ]);

        Currency::create([
            'name' => 'British Pound Sterling',
            'symbol' => '£',
            'exchange_rate' => 1400,
            'code' => 'GBP',
            'icon' => '🇬🇧',
        ]);

        Currency::create([
            'name' => 'US Dollar',
            'symbol' => '$',
            'exchange_rate' => 1140,
            'code' => 'USD',
            'icon' => '🇺🇸',
        ]);

    }
}
