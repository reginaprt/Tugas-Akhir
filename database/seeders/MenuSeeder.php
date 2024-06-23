<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $foods = [
            [
                'nama' => 'Bubur Daging Tomat',
                'resep' => 'Campur daging tomat dengan beras dan air, masak hingga mendidih.',
                'energi' => 247,
                'protein' => 15,
                'lemak' => 10,
                'karbo' => 25,
            ],
            [
                'nama' => 'Bubur Kentang Telur Kornet',
                'resep' => 'Campur kentang, telur, dan kornet dengan air, masak hingga kental.',
                'energi' => 246,
                'protein' => 10,
                'lemak' => 16,
                'karbo' => 17,
            ],
            [
                'nama' => 'Bubur Kentang Tahu',
                'resep' => 'Campur kentang dan tahu dengan air, masak hingga matang.',
                'energi' => 144,
                'protein' => 6,
                'lemak' => 3,
                'karbo' => 25,
            ],
            [
                'nama' => 'Bubur Keju Daging Kentang',
                'resep' => 'Campur keju, daging, dan kentang dengan air, masak hingga keju meleleh.',
                'energi' => 167,
                'protein' => 5,
                'lemak' => 10,
                'karbo' => 31,
            ],
            [
                'nama' => 'Bubur Kentang Telur Keju',
                'resep' => 'Campur kentang, telur, dan keju dengan air, masak hingga matang.',
                'energi' => 246,
                'protein' => 10,
                'lemak' => 16,
                'karbo' => 17,
            ],
            [
                'nama' => 'Nasi Sup Makaroni Bola Ayam',
                'resep' => 'Masak nasi dengan sup, tambahkan makaroni dan bola-bola ayam.',
                'energi' => 355,
                'protein' => 11,
                'lemak' => 7,
                'karbo' => 36,
            ],
            [
                'nama' => 'Nasi Sup Udang Tofu',
                'resep' => 'Masak nasi dengan sup, tambahkan udang dan tofu.',
                'energi' => 206,
                'protein' => 13,
                'lemak' => 5,
                'karbo' => 5,
            ],
            [
                'nama' => 'Nasi Tumis Brokoli Sosis',
                'resep' => 'Tumis brokoli dan sosis, masak nasi hingga matang, campurkan.',
                'energi' => 257,
                'protein' => 7,
                'lemak' => 8,
                'karbo' => 16,
            ],
            [
                'nama' => 'Nasi Tumis Makaroni Sosis',
                'resep' => 'Tumis makaroni dan sosis, masak nasi hingga matang, campurkan.',
                'energi' => 291,
                'protein' => 7,
                'lemak' => 4,
                'karbo' => 32,
            ],
        ];

        // Insert data into database using DB facade
        foreach ($foods as $food) {
            DB::table('menus')->insert([
                'nama' => $food['nama'],
                'resep' => $food['resep'],
                'energi' => $food['energi'],
                'protein' => $food['protein'],
                'lemak' => $food['lemak'],
                'karbo' => $food['karbo'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
