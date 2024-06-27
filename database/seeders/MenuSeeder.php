<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $foods = [
            ['nama' => 'Bubur Daging Tomat (1 Porsi)', 'energi' => 246.8, 'protein' => 14.6, 'lemak' => 9.2, 'karbo' => 24.7, 'bahan' => 'Daging, tomat, bawang, beras, air', 'cara' => 'Masak daging dengan tomat dan bawang, tambahkan beras dan air, didihkan hingga matang.'],
            ['nama' => 'Bubur Kentang Telur Keju (2 Porsi)', 'energi' => 246.1, 'protein' => 10.4, 'lemak' => 15.9, 'karbo' => 16.8, 'bahan' => 'Kentang, telur, keju, air, garam', 'cara' => 'Rebus kentang, campur dengan telur dan keju, masak hingga matang.'],
            ['nama' => 'Bubur Kentang Tahu (1 Porsi)', 'energi' => 144.3, 'protein' => 6.5, 'lemak' => 2.7, 'karbo' => 25.1, 'bahan' => 'Kentang, tahu, bawang, garam, air', 'cara' => 'Rebus kentang, tambahkan tahu dan bawang, masak dengan air hingga lembut.'],
            ['nama' => 'Bubur Keju Daging Kentang (2 Porsi)', 'energi' => 167.2, 'protein' => 5.4, 'lemak' => 9.4, 'karbo' => 30.8, 'bahan' => 'Keju, daging, kentang, bawang, garam', 'cara' => 'Goreng daging dan kentang, tambahkan keju dan bawang, masak hingga keju meleleh.'],
            ['nama' => 'Nasi Sup Makaroni Bola Ayam (2 Porsi)', 'energi' => 384.2, 'protein' => 14.26, 'lemak' => 7.48, 'karbo' => 64.4, 'bahan' => 'Nasi, ayam, makaroni, bawang, wortel, kaldu', 'cara' => 'Rebus nasi dan makaroni, tambahkan bola ayam, bawang, wortel, rebus hingga matang.'],
            ['nama' => 'Nasi Sup Udang Tofu (2 Porsi)', 'energi' => 235.2, 'protein' => 15.26, 'lemak' => 5.68, 'karbo' => 32.9, 'bahan' => 'Nasi, udang, tofu, wortel, bawang, kaldu', 'cara' => 'Rebus nasi, tambahkan udang dan tofu, bawang, wortel, rebus hingga matang.'],
            ['nama' => 'Nasi Tumis Brokoli Sosis (2 Porsi)', 'energi' => 286.3, 'protein' => 9.56, 'lemak' => 8.38, 'karbo' => 44.4, 'bahan' => 'Nasi, brokoli, sosis, bawang, minyak, garam', 'cara' => 'Tumis sosis dengan bawang, tambahkan brokoli dan nasi, aduk hingga matang.'],
            ['nama' => 'Nasi Tumis Makaroni Sosis (3 Porsi)', 'energi' => 320.5, 'protein' => 9.96, 'lemak' => 3.88, 'karbo' => 60.3, 'bahan' => 'Nasi, makaroni, sosis, bawang, minyak, garam', 'cara' => 'Tumis sosis dengan bawang, tambahkan makaroni dan nasi, aduk hingga matang.'],
            ['nama' => 'Nasi Pangsit Kuah (5 Porsi)', 'energi' => 336.8, 'protein' => 21.06, 'lemak' => 11.28, 'karbo' => 36, 'bahan' => 'Nasi, pangsit, ayam, wortel, bawang, kaldu', 'cara' => 'Rebus nasi dan pangsit, tambahkan ayam, bawang, wortel, rebus hingga matang.'],
            ['nama' => 'Nasi Sayur Bening Bayam (2 Porsi)', 'energi' => 214, 'protein' => 8.56, 'lemak' => 2.38, 'karbo' => 40.2, 'bahan' => 'Nasi, bayam, wortel, bawang, garam', 'cara' => 'Rebus nasi dengan bayam, wortel, dan bawang, tambahkan garam, rebus hingga matang.'],
            ['nama' => 'Nasi Sup Kacang Merah (3 Porsi)', 'energi' => 267.4, 'protein' => 11.26, 'lemak' => 3.68, 'karbo' => 44.8, 'bahan' => 'Nasi, kacang merah, wortel, bawang, kaldu', 'cara' => 'Rebus nasi dan kacang merah, tambahkan bawang, wortel, rebus hingga matang.'],
            ['nama' => 'Nasi Bakso (25 Buah)', 'energi' => 152.9, 'protein' => 4.56, 'lemak' => 1.48, 'karbo' => 29.4, 'bahan' => 'Nasi, bakso, wortel, bawang, garam', 'cara' => 'Rebus nasi dan bakso, tambahkan wortel dan bawang, rebus hingga matang.'],
            ['nama' => 'Nasi Perkedel Daging (6 Buah)', 'energi' => 225.7, 'protein' => 6.96, 'lemak' => 7.28, 'karbo' => 32.6, 'bahan' => 'Nasi, daging, telur, bawang, garam', 'cara' => 'Goreng daging dan perkedel, tambahkan nasi dan bawang, goreng hingga matang.'],
            ['nama' => 'Nasi Nugget Ikan Tahu (6 Buah)', 'energi' => 249.1, 'protein' => 12.86, 'lemak' => 6.48, 'karbo' => 33.9, 'bahan' => 'Nasi, ikan, tahu, bawang, tepung', 'cara' => 'Goreng ikan dan tahu, campur dengan nasi, bawang, dan tepung, goreng hingga matang.'],
            ['nama' => 'Nasi Tahu Makaroni Kukus (3 Porsi)', 'energi' => 389.8, 'protein' => 18.36, 'lemak' => 10.58, 'karbo' => 55.6, 'bahan' => 'Nasi, tahu, makaroni, bawang, kecap', 'cara' => 'Kukus nasi, tahu, dan makaroni dengan bawang dan kecap hingga matang.'],
            ['nama' => 'Nasi Bola daging kecap (2 Porsi)', 'energi' => 303.8, 'protein' => 11.96, 'lemak' => 6.68, 'karbo' => 48.4, 'bahan' => 'Nasi, daging, kecap, bawang, minyak', 'cara' => 'Tumis daging dengan kecap dan bawang, tambahkan nasi, aduk hingga matang.'],
            ['nama' => 'Nasi Sop Gurame (2 Porsi)', 'energi' => 265.5, 'protein' => 16.76, 'lemak' => 4.78, 'karbo' => 39.3, 'bahan' => 'Nasi, gurame, bawang, kaldu', 'cara' => 'Rebus nasi, tambahkan gurame dan bawang, rebus hingga matang.'],
            ['nama' => 'Nasi Pepes Nila (1 Porsi)', 'energi' => 237.8, 'protein' => 13.96, 'lemak' => 3.78, 'karbo' => 36, 'bahan' => 'Nasi, nila, daun pisang, bumbu rempah', 'cara' => 'Bungkus nasi dan ikan nila dengan daun pisang, tambahkan bumbu rempah, kukus hingga matang.'],
            ['nama' => 'Nasi Rolade Tahu Sosis (8 Potong)', 'energi' => 241.4, 'protein' => 5.96, 'lemak' => 8.18, 'karbo' => 30.9, 'bahan' => 'Nasi, tahu, sosis, telur, wortel, bawang', 'cara' => 'Gulung nasi, tahu, sosis, telur, wortel, dan bawang, kukus hingga matang.'],
            ['nama' => 'Nasi Ayam Crispy Lapis Sayuran (3 Porsi)', 'energi' => 436.2, 'protein' => 23.06, 'lemak' => 20.68, 'karbo' => 35.2, 'bahan' => 'Nasi, ayam crispy, sayuran (wortel, kubis), saus', 'cara' => 'Susun nasi dengan ayam crispy dan sayuran, tambahkan saus, tumpuk dan sajikan.'],
            ['nama' => 'Nasi Nugget Ayam Sayur (15 Buah)', 'energi' => 198.7, 'protein' => 7.36, 'lemak' => 5.28, 'karbo' => 29.4, 'bahan' => 'Nasi, nugget ayam, sayuran (kacang panjang, wortel), saus', 'cara' => 'Goreng nugget ayam, tambahkan nasi dan sayuran, aduk dan sajikan.'],
            ['nama' => 'Nasi Bakso Ayam Jamur (5 Porsi)', 'energi' => 519.7, 'protein' => 20.16, 'lemak' => 16.58, 'karbo' => 73.3, 'bahan' => 'Nasi, bakso ayam, jamur, bawang, kecap', 'cara' => 'Tumis bakso ayam dan jamur dengan bawang dan kecap, tambahkan nasi, aduk dan sajikan.'],
            ['nama' => 'Nasi Dadar Makaroni Sayur (9 Potong)', 'energi' => 249.1, 'protein' => 10.86, 'lemak' => 8.18, 'karbo' => 31.2, 'bahan' => 'Nasi, dadar, makaroni, sayuran (wortel, kubis), bumbu', 'cara' => 'Gulung nasi dengan dadar, makaroni, dan sayuran, tambahkan bumbu, kukus hingga matang.'],
            ['nama' => 'Nasi Steak Tempe (4 Porsi)', 'energi' => 425.6, 'protein' => 23.86, 'lemak' => 16.78, 'karbo' => 43.9, 'bahan' => 'Nasi, steak tempe, bawang, saus', 'cara' => 'Goreng steak tempe dengan bawang dan saus, tambahkan nasi, aduk dan sajikan.'],
        ];

        // Insert data into database using DB facade
        foreach ($foods as $food) {
            DB::table('menus')->insert([
                'nama' => $food['nama'],
                'bahan' => $food['bahan'],
                'cara' => $food['cara'],
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
