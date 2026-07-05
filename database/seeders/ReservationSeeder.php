<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil semua ID menu yang sudah di-seed sebelumnya
        $menuIds = Menu::pluck('id')->toArray();

        // Jika tabel menus masih kosong, jalankan factory standar saja
        if (empty($menuIds)) {
            Reservation::factory()->count(70)->create();
            return;
        }

        // 2. Generate 70 data reservasi
        Reservation::factory()->count(70)->create()->each(function ($reservation) use ($menuIds) {
            // Setiap reservasi akan memesan 2 sampai 5 menu secara acak
            $randomMenuIds = (array) array_rand(array_flip($menuIds), rand(2, 5));

            $pivotData = [];
            foreach ($randomMenuIds as $menuId) {
                // Berikan jumlah porsi acak antara 1 sampai 3 porsi per menu
                $pivotData[$menuId] = ['quantity' => rand(1, 3)];
            }

            // Hubungkan reservasi dengan menu melalui table pivot (misal nama relasinya: menus)
            // Pastikan relasi ini sudah didefinisikan di Model Reservation kamu
            if (method_exists($reservation, 'menus')) {
                $reservation->menus()->attach($pivotData);
            }
        });
    }
}
