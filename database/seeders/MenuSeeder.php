<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [];
        for ($i = 1; $i <= 10; $i++) {
            $menus[] = [
                'nama' => 'Makanan ' . $i,
                'energi' => rand(100, 500),
                'protein' => rand(1, 20),
                'lemak' => rand(1, 20),
                'karbo' => rand(10, 50),
                'resep' => 'Resep ' . $i,
            ];
        }

        DB::table('menus')->insert($menus);
    }
}
