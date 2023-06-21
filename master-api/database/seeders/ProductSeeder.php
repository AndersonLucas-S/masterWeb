<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Product::truncate();

        Product::create([
            'name' => 'Notebook Dell Inspiron I15-3583-A30P',
            'description' => 'Intel Core i5 - 8GB 256GB SSD 15,6” Windows 10',
        ]);

        Product::create([
            'name' => 'Smartphone Samsung Galaxy A71',
            'description' => '128GB 6GB RAM Tela 6,7” Câm. Quádrupla + Selfie 32MP',
        ]);

        Product::create([
            'name' => 'Smart TV LED 50” UHD 4K Samsung 50TU8000 Crystal UHD',
            'description' => 'Bluetooth HDR 3 HDMI 2 USB Wi-Fi',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
