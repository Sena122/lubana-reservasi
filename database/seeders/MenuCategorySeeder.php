<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuCategorySeeder extends Seeder
{
    public function run(): void
    {
        // Menghindari duplikasi saat di-seed ulang
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('menu_categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            ['id' => 1, 'name' => 'Paketan Keluarga'],
            ['id' => 2, 'name' => 'Paket Perorang'],
            ['id' => 3, 'name' => 'Paket Hemat'],
            ['id' => 4, 'name' => 'Seafood'],
            ['id' => 5, 'name' => 'Ikan Air Tawar'],
            ['id' => 6, 'name' => 'Menu Khas & Cobek'],
            ['id' => 7, 'name' => 'Ayam & Lauk Satuan'],
            ['id' => 8, 'name' => 'Sayuran'],
            ['id' => 9, 'name' => 'Nasi & Mie'],
            ['id' => 10, 'name' => 'Sambal & Pelengkap'],
            ['id' => 11, 'name' => 'Snack & Cemilan'],
            ['id' => 12, 'name' => 'Jajanan Moro-Moro'],
        ];

        foreach ($categories as $category) {
            DB::table('menu_categories')->insert([
                'id' => $category['id'],
                'name' => $category['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
