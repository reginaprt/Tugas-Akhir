<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $foods = [
            ['nama' => 'Bubur Daging Tomat (1 Porsi)', 'energi' => 246.8, 'protein' => 14.6, 'lemak' => 9.2, 'karbo' => 24.7,   'bahan' => 
                                                                                                                                        '1. 50gr daging giling
                                                                                                                                        2. 45gr beras
                                                                                                                                        3. 3 gelas air  putih
                                                                                                                                        4. 1 buah tomat
                                                                                                                                        5. 1 siung bawang', 
                                                                                                                                'cara' => 
                                                                                                                                        '1. Masukan air dan beras kedapam panci. Didihkan
                                                                                                                                        2. Setelah mendidih kecilkan api, masukan daging giling
                                                                                                                                        3. Aduk sesekali agar daging tidak menggumpal
                                                                                                                                        4. Setelah matang dan air habis, masukan tomat dan bawang putih
                                                                                                                                        5. Aduk hingga tercampur rata'],
            ['nama' => 'Bubur Kentang Telur Keju (2 Porsi)', 'energi' => 246.1, 'protein' => 10.4, 'lemak' => 15.9, 'karbo' => 16.8,    'bahan' => 
                                                                                                                                                '1. 1 buah kentang parut
                                                                                                                                                2. 1 buah wortel parut
                                                                                                                                                3. 1 buah telur
                                                                                                                                                4. 1 siung bawang putih dan merah
                                                                                                                                                5. bawang bombay secukupnya
                                                                                                                                                6. keju secukupnya
                                                                                                                                                7. margarin secukupnya
                                                                                                                                                8. air secukupnya
                                                                                                                                                9. garam secukupnya', 
                                                                                                                                        'cara' => 
                                                                                                                                                '1. Cincang halus bawang putih, bawang merah dan bawang bombay
                                                                                                                                                2. Panaskan margarin dan tumis semua bawang cincang hingga harum
                                                                                                                                                3. Tambahkan air kemudian masukkan parutan kentang dan wortel sambil diaduk aduk
                                                                                                                                                4. Masukan telur dan masak hingga airnya menyusut dan matang
                                                                                                                                                5. Sajikan dan taburkan keju parut'],
            ['nama' => 'Bubur Kentang Tahu (1 Porsi)', 'energi' => 144.3, 'protein' => 6.5, 'lemak' => 2.7, 'karbo' => 25.1,    'bahan' => 
                                                                                                                                        '1. 2 buah kentang
                                                                                                                                        2. 1/2 tahu
                                                                                                                                        3. 1 gelas kaldu sayur atau kaldu ikan', 
                                                                                                                                'cara' => 
                                                                                                                                        '1. Tumpuk kentang dan tahu hingga lembut
                                                                                                                                        2. Tuang kaldu dalam panci. Tunggu hingga mendidih
                                                                                                                                        3. Masukan tahu dan ketang. Aduk sebentar dan kecilkan api
                                                                                                                                        4. Masak hingga kaldu menyusut, sesekali aduk agar tidak lengket
                                                                                                                                        5. Setelah kaldu menyusut, maka hidangkan Rebus kentang'],
            ['nama' => 'Bubur Keju Daging Kentang (2 Porsi)', 'energi' => 167.2, 'protein' => 5.4, 'lemak' => 9.4, 'karbo' => 30.8, 'bahan' => 
                                                                                                                                            '1. 30gr beras, 
                                                                                                                                            2. 50gr kentang, potong kecil
                                                                                                                                            3. 20gr daging cincang
                                                                                                                                            4. 1 buah bawang merah dan bawang putih
                                                                                                                                            5. 1 sdm minyak zaitun
                                                                                                                                            6. 2 sdm keju parut
                                                                                                                                            7. 300ml air',
                                                                                                                                    'cara' => 
                                                                                                                                            '1. Masukan minyak zaitun, tumis bawang merah dan bawang putih sampai harum
                                                                                                                                            2. Masukan daging dan aduk rata
                                                                                                                                            3. Tambahkan air dan tunggu sampai mendidih
                                                                                                                                            4. Setelah mendidih kecilkan api
                                                                                                                                            5. Masukan berada serta kentang, aduk hingga merata.'],
            ['nama' => 'Nasi Sup Makaroni Bola Ayam (2 Porsi)', 'energi' => 384.2, 'protein' => 14.26, 'lemak' => 7.48, 'karbo' => 64.4,    'bahan' => 
                                                                                                                                                    '1. 50gr daging giling, bikin menjadi bola bola
                                                                                                                                                    2. 2 buah kentang, potong dadu
                                                                                                                                                    3. 5 sdm makaroni
                                                                                                                                                    4. 1 buah tomat, potong dadu
                                                                                                                                                    5. 1 buah wortel, potong dadu
                                                                                                                                                    6. 3 siung bawang putih, iris tipis
                                                                                                                                                    7. 2 siung bawang merah, iris tipis
                                                                                                                                                    8. 5gr margarin
                                                                                                                                                    9. 100gr beras', 
                                                                                                                                            'cara' => 
                                                                                                                                                    '1. Rebus daging ayam bersama bawang. Masukan makaroni dan kentang
                                                                                                                                                    2. Tambahkan tomat dan wortel. Masak hingga matang
                                                                                                                                                    3. Tambahkan margarin sesaat sebelum disajikan'],
            ['nama' => 'Nasi Sup Udang Tofu (2 Porsi)', 'energi' => 235.2, 'protein' => 15.26, 'lemak' => 5.68, 'karbo' => 32.9,    'bahan' => 
                                                                                                                                            '1. 6 udang dikupas dan cincang
                                                                                                                                            2. 1 buah tofu
                                                                                                                                            3. 2 siung bawang putih dan merah iris tipis
                                                                                                                                            4. bawang bombay secukupnya
                                                                                                                                            5. 3 lembar daun jeruk
                                                                                                                                            6. 1 sdt minyak zaitun
                                                                                                                                            7. 100gr beras', 
                                                                                                                                    'cara' => 
                                                                                                                                            '1. Rebus udang bersama bawang merah, bawang putih, bawang bombay dan daun jeruk
                                                                                                                                            2. Setelah setengah matang, masukan tofu
                                                                                                                                            3. Masak hingga matang
                                                                                                                                            4. Tambahkan minyak zaitun dan sajikan'],
            ['nama' => 'Nasi Tumis Brokoli Sosis (2 Porsi)', 'energi' => 286.3, 'protein' => 9.56, 'lemak' => 8.38, 'karbo' => 44.4,    'bahan' => 
                                                                                                                                                '1. 100gr brokoli, potong potong
                                                                                                                                                2. 100gr wortel, potong potong
                                                                                                                                                3. 4 buah sosis
                                                                                                                                                4. 1 buah bawang bombay, iris
                                                                                                                                                5. 4 siung bawang putih, iris
                                                                                                                                                6. 1/2 sdt garam
                                                                                                                                                7. 1.2 std gula
                                                                                                                                                8. air secukupnya
                                                                                                                                                9. margarin secukupnya', 
                                                                                                                                        'cara' => 
                                                                                                                                                '1. Panaskan margarin dan tumis bawang putih dan bawang bombay sampai harum
                                                                                                                                                2. Tambahkan air tunggu hingga mendidih kemudian tambahkan garam dan gula
                                                                                                                                                3. Masukan sosis dan wortel tunggu sampai wortel empuk
                                                                                                                                                4. Masukan brokoli aduk sampai matang'],
            ['nama' => 'Nasi Tumis Makaroni Sosis (2 Porsi)', 'energi' => 320.5, 'protein' => 9.96, 'lemak' => 3.88, 'karbo' => 60.3,   'bahan' => 
                                                                                                                                                '1. 2 genggam makaroni, rebus sampai empuk
                                                                                                                                                2. 3 buah sosis, iris
                                                                                                                                                3. 3 siung bawang merah, iris
                                                                                                                                                4. 2 siung bawang putih, cincang
                                                                                                                                                5. 1/2 siung bawang bombay, iris
                                                                                                                                                6. 1 sdt saus tomat
                                                                                                                                                7. 2 sdt saus tiram
                                                                                                                                                8. 2 sdm kecap manis
                                                                                                                                                9. garam secukupnya
                                                                                                                                                10. gula secukupnya
                                                                                                                                                11. tepung maizena secukupnya
                                                                                                                                                12. 100gr beras', 
                                                                                                                                        'cara' => 
                                                                                                                                                '1. Tumis bawang merah, bawang putih dan bawang bombay
                                                                                                                                                2. Masukan sosis, beri sedikit air, masukan saos, kecap manis, gula dan garam
                                                                                                                                                3. Tambahkan makaroni
                                                                                                                                                4. Tambahkan sedikit tepung maizena yang sudah dilarutkan dalam air 1 sdm
                                                                                                                                                5. Sajikan'],
            ['nama' => 'Nasi Pangsit Kuah (2 Porsi)', 'energi' => 336.8, 'protein' => 21.06, 'lemak' => 11.28, 'karbo' => 36,   'bahan' => 
                                                                                                                                        '1. Kulit pangsir secukupnya
                                                                                                                                        2. Sawi rebus
                                                                                                                                        3. 100gr beras

                                                                                                                                        BAHAN ISI :
                                                                                                                                        1. 250gr daging cincang
                                                                                                                                        2. 100gr udang cincang
                                                                                                                                        3. 1 buah telur 
                                                                                                                                        4. 5 sdm maizena
                                                                                                                                        5. 1 buah wortel parut
                                                                                                                                        6. 1 batang daun bawang, iris
                                                                                                                                        7. garam secukupnya
                                                                                                                                        8. gula secukupnya
                                                                                                                                        
                                                                                                                                        BAHAN KUAH :
                                                                                                                                        1. 2 buah sayap ayam
                                                                                                                                        2. 1 siung bawang putih, geprek
                                                                                                                                        3. garam secukupnya
                                                                                                                                        4. gula secukupnya
                                                                                                                                        5. 1 sdt minyak wijen', 
                                                                                                                                'cara' => 
                                                                                                                                        '1. Campur semua bahan isi aduk rata
                                                                                                                                        2. Ambil 1 lembar kulit pangsit, Isi secukupnya dengan bahan isian, Lipat segitiga kemudian lem ujungnya dengan air
                                                                                                                                        3. Rebus pangsit sampai matang
                                                                                                                                        
                                                                                                                                        BAHAN KUAH :
                                                                                                                                        1. Didihkan air dalam panci. Masukan sayap ayam dan bawang putih geprek. Rebus sampai kaldu keluar
                                                                                                                                        2. Tambahkan garam dan gula. Matikan api dan masukan minyak wijen. Aduk rata
                                                                                                                                        3. Tata pangsit rebus dan sawi ke dalam mangkuk kemudian siram dengan kuah.'],
            ['nama' => 'Nasi Sayur Bening Bayam (2 Porsi)', 'energi' => 214, 'protein' => 8.56, 'lemak' => 2.38, 'karbo' => 40.2,       'bahan' => 
                                                                                                                                                '1. 1 ikat bayam
                                                                                                                                                2. i potong kecil tempe
                                                                                                                                                3. 200 ml kaldu udang
                                                                                                                                                4. 1 buah tomat, iris
                                                                                                                                                5. 2 siung bawang putih merah, iris
                                                                                                                                                6. gula secukupnya
                                                                                                                                                7. garam secukupnya
                                                                                                                                                8. 100gr beras', 
                                                                                                                                        'cara' => 
                                                                                                                                                '1. Masak air setengah panci sedang hingga mendidih kemudian tambahan kaldu udang
                                                                                                                                                2. Masukan bawang merah, tomat dan tempe sampai agak layu
                                                                                                                                                3. Masukan bayam dan beri gula serta garam secukupnya
                                                                                                                                                4. Angkat dan sajikan'],
            ['nama' => 'Nasi Sup Kacang Merah (2 Porsi)', 'energi' => 267.4, 'protein' => 11.26, 'lemak' => 3.68, 'karbo' => 44.8,      'bahan' => 
                                                                                                                                                '1. 50gr kacang merah
                                                                                                                                                2. 1/2 buah wortel potong dadu
                                                                                                                                                3. 1 buah tomat, potong dadu
                                                                                                                                                4. 50gr daging giling
                                                                                                                                                5. 3 batang seledri cincang
                                                                                                                                                6. 100gr beras
                                                                                                                                                7. 1L air
                                                                                                                                                8. 1 siung bawang putih geprek
                                                                                                                                                9. 1/2 buah bawang bombay, cincang
                                                                                                                                                10. garam secukupnya
                                                                                                                                                11. gula secukupnya
                                                                                                                                                12. merica secukupnya', 
                                                                                                                                        'cara' => 
                                                                                                                                                '1. Rebus kacang merah hingga empuk kemudian masukan bawang putih
                                                                                                                                                2. Tumis bawang bombay sampai kecoklatan, masukkan daging giling dan sedikit garam
                                                                                                                                                3. Masukkan ke dalam kuah kacang merah dan didihkan kembali
                                                                                                                                                4. Masukan wortel dan seledri serta beri sedikit garam, gula dan lada. Masak sampai wortel dan daging empuk
                                                                                                                                                5. Masukan tomat dan aduk rata hingga semua benar benar matang'],
            ['nama' => 'Nasi Bakso (25 Buah)', 'energi' => 152.9, 'protein' => 4.56, 'lemak' => 1.48, 'karbo' => 29.4,  'bahan' => 
                                                                                                                                '1. 1 bagian daring ayam
                                                                                                                                2. 2 buah tahu putih
                                                                                                                                3. 1 buah wortel sedang, potong potong
                                                                                                                                4. 1/4 ikat bayam, potong potong
                                                                                                                                5. 2 siung bawang putih
                                                                                                                                6. 1/4 sdt merica
                                                                                                                                7. 1 sdt garam
                                                                                                                                8. 1 butir telur
                                                                                                                                9. 1 sdm tepung terigu
                                                                                                                                10. sdm tepung tapioka', 
                                                                                                                        'cara' => 
                                                                                                                                '1. Potong ayam dan tahu. Masukan wortel, bayam dan telur. Blender hingga halus
                                                                                                                                2. Haluskan bawang putih, garam dan merica. Masukkan ke dalam adonan dan blender kembali hingga rata
                                                                                                                                3. Tambahkan tepung terigu dan tepung tapioka. Aduk hingga merata
                                                                                                                                4. Panaskan air hingga mendidih
                                                                                                                                5. Cetak adonan dengan tangan atau 2 buah sendok. Rebus hingga mengambang dan matang. Tiriskan'],
            ['nama' => 'Nasi Perkedel Daging (6 Buah)', 'energi' => 225.7, 'protein' => 6.96, 'lemak' => 7.28, 'karbo' => 32.6, 'bahan' => 
                                                                                                                                        '1. 2 buah kentang, potong dadu
                                                                                                                                        2. 2 sdm daging giling
                                                                                                                                        3. 50gr tahu, potong kecil
                                                                                                                                        4. 2 siung barang putih
                                                                                                                                        5. 1 batang saledri, cincang
                                                                                                                                        6. 1 batang bawang daun, cincang
                                                                                                                                        7. 1 butir telur
                                                                                                                                        8. garam secukupnya
                                                                                                                                        9. minyak secukupnya
                                                                                                                                        10 100gr nasi', 
                                                                                                                                'cara' => 
                                                                                                                                        '1. Kukus kentang terlebih dahulu selama 10 menit, lalu masukan tahu, kukus kembali selama 5 menit
                                                                                                                                        2. Ulek kentang, tahu, bawang putih dan garam
                                                                                                                                        3. Masukan daging giling, saledri dan daun bawang
                                                                                                                                        4. Aduk hingga tercampur rata dan bentuk bulan pipih
                                                                                                                                        5. Lumuei bulatan adonan dengan telur dan goreng hingga matang kuning kecoklatan'],
            ['nama' => 'Nasi Nugget Ikan Tahu (6 Buah)', 'energi' => 249.1, 'protein' => 12.86, 'lemak' => 6.48, 'karbo' => 33.9,       'bahan' => 
                                                                                                                                                '1. 200gr daging ikan, cincang
                                                                                                                                                2. 100gr tahu putih
                                                                                                                                                3. 1 butir telur
                                                                                                                                                4. 50gr wortel, diparut
                                                                                                                                                5. 50gr bawang bombay cincang
                                                                                                                                                6. 3 buah bawang putih cincang
                                                                                                                                                7. 2 buah bawang merah, cincang
                                                                                                                                                8. 2 sdm terigu
                                                                                                                                                9. 2 sdm tepung roti
                                                                                                                                                10. 1 sdt minyak wijen
                                                                                                                                                11. garam dan kaldu secukupnya
                                                                                                                                                12. 100gr beras
                                                                                                                                                
                                                                                                                                                BAHAN PELAPIS :
                                                                                                                                                1. 1 buah telur kocok + air secukupnya + terigu, aduk hingga kental
                                                                                                                                                2. Tepung panir secukupnya', 
                                                                                                                                        'cara' => 
                                                                                                                                                '1. Campur semua bahan utama menjadi satu sampai merata
                                                                                                                                                2. Bentuk adonan menjadi kotak pipih
                                                                                                                                                3. Kukus selama 15 - 20 menit. Setelah matang dinginkan
                                                                                                                                                4. Setelah agak dingin. Potong nugget sesuai selera
                                                                                                                                                5. Celumpkan kedalam bahan pelapis, kemudian lumuri dengan tepung panir
                                                                                                                                                6. Simpan di kulkas kurang lebih 30 menit
                                                                                                                                                7. Goreng nugget hingga matang'],
            ['nama' => 'Nasi Tahu Makaroni Kukus (2 Porsi)', 'energi' => 389.8, 'protein' => 18.36, 'lemak' => 10.58, 'karbo' => 55.6,  'bahan' => 
                                                                                                                                                '1. 250gr tahu putih
                                                                                                                                                2. 100gr makaroni, rebus
                                                                                                                                                3. 4 sdm wortel parut
                                                                                                                                                4. 1 sdm keju parut
                                                                                                                                                5. daun seledri secukupnya
                                                                                                                                                6. 2 kuning telur
                                                                                                                                                7. 100gr beras', 
                                                                                                                                        'cara' => 
                                                                                                                                                '1. Haluskan tahu dan makaroni
                                                                                                                                                2. Tambah wortel, kuning telur, seledri dan keju parut
                                                                                                                                                3. Kukus kurang lebih 20 menit/sampai matang
                                                                                                                                                4. Sajikan'],
            ['nama' => 'Nasi Bola daging kecap (2 Porsi)', 'energi' => 303.8, 'protein' => 11.96, 'lemak' => 6.68, 'karbo' => 48.4,     'bahan' => 
                                                                                                                                                '1. 50gr daging giling
                                                                                                                                                2. 2 sdt tepung terigu
                                                                                                                                                3. 1 sdt tepung sagu
                                                                                                                                                4. garam secukupnya
                                                                                                                                                5. air secukupnya
                                                                                                                                                6. 1 siung bawang putih, dihaluskan
                                                                                                                                                7. 1/2 siung bawang putih
                                                                                                                                                8. 1/4 buah kemiri
                                                                                                                                                9. ketumbar secukupnya
                                                                                                                                                10. lada secukupnya
                                                                                                                                                11. 100gr beras', 
                                                                                                                                        'cara' => 
                                                                                                                                                '1. Campur bahan bola daging menjadi satu. Aduk sampai kalis
                                                                                                                                                2. SIapkan panci dan didihkan air. Buat adonan daging menjadi bulatan kecil rebus
                                                                                                                                                3. Tiriskan bola daging yang sudang mengambang
                                                                                                                                                4. Tumis bumbu halus, daun salam, lengkuas, jahe sampai matang. Masukkan bola bola daging, wortel, buncis dan air rebusan daging.
                                                                                                                                                5. Tambahkan kecap, garam dan gula
                                                                                                                                                6. Masak sampai mengental'],
            ['nama' => 'Nasi Sop Gurame (2 Porsi)', 'energi' => 265.5, 'protein' => 16.76, 'lemak' => 4.78, 'karbo' => 39.3,    'bahan' => 
                                                                                                                                        '1. 2 potong ikan gurame
                                                                                                                                        2. 1/2 buah wortel
                                                                                                                                        3. 1/2 buah labu siam
                                                                                                                                        4. 2 buah tahu
                                                                                                                                        5. 1/2 buah kentang
                                                                                                                                        6. 2 batang daun bawang
                                                                                                                                        7. 2 buah bawang putih
                                                                                                                                        8. 2 lembar saun jeruk
                                                                                                                                        9. 1 batang serai
                                                                                                                                        10. gula dan garam secukupnya
                                                                                                                                        11. air secukupnya
                                                                                                                                        12. minyak untuk menummis secukupnya
                                                                                                                                        13. 100gr beras', 
                                                                                                                                'cara' => 
                                                                                                                                        '1. Tumis bawang putih, serai dan daun jeruk hingga harum
                                                                                                                                        2. Masukkan air, ikan gurame, wortel, kentang dan labu siam
                                                                                                                                        3. Tunggu sampai wortel, kentang dan labusiam lunak
                                                                                                                                        4. Tambahkan gula dan garam. Aduk dan tunggu mendidih
                                                                                                                                        5. Tambahkan dua bawang dan sajikan'],
            ['nama' => 'Nasi Pepes Nila (1 Porsi)', 'energi' => 237.8, 'protein' => 13.96, 'lemak' => 3.78, 'karbo' => 36,      'bahan' => 
                                                                                                                                        '1. 1 ekor ikan nila
                                                                                                                                        2. air untuk mengukus
                                                                                                                                        3. daun pisang untuk membungkus
                                                                                                                                        4. 3 siung bawang putih
                                                                                                                                        5. 5 siung bawang merah
                                                                                                                                        6. 1 ruas kunyit
                                                                                                                                        7. 2 ruas temulawak
                                                                                                                                        8. 2 ruas lengkuas
                                                                                                                                        9. 2 batang serai
                                                                                                                                        10. garam dan gula secukupnya
                                                                                                                                        11. 1 ruas jahe
                                                                                                                                        12. 100gr beras', 
                                                                                                                                'cara' => 
                                                                                                                                        '1. Bersihkan ikan. SUsun diatas daun pisang
                                                                                                                                        2. Blender hingga halus semua bumbu kecuali serai
                                                                                                                                        3. Tuang bumbu halus dan serai
                                                                                                                                        4. Kukus kurang lebih 15 menit
                                                                                                                                        5. Angkat dan sajikan'],
            ['nama' => 'Nasi Rolade Tahu Sosis (8 Potong)', 'energi' => 241.4, 'protein' => 5.96, 'lemak' => 8.18, 'karbo' => 30.9,     'bahan' => 
                                                                                                                                                '1. buah tahu
                                                                                                                                                2. 1 siung bawang putih
                                                                                                                                                3. 50gr daging cincang
                                                                                                                                                4. 1 buah wortel
                                                                                                                                                5. 1 batang daun bawang
                                                                                                                                                6. garam secukupya
                                                                                                                                                7. 1 butir telor
                                                                                                                                                8. 1 buah sosis
                                                                                                                                                9. 100gr beras', 
                                                                                                                                        'cara' => 
                                                                                                                                                '1. Camputkan semua bahan kecuali telur dan sosis
                                                                                                                                                2. Ratakan adonan di atas aluamunium foil
                                                                                                                                                3. Kukus hingga 20 - 30 menit
                                                                                                                                                4. Potong rolade kemudian celupkan kedalam telur dan goreng'],
            ['nama' => 'Nasi Ayam Crispy Lapis Sayuran (2 Porsi)', 'energi' => 436.2, 'protein' => 23.06, 'lemak' => 20.68, 'karbo' => 35.2,    'bahan' => 
                                                                                                                                                        '1. 250gr dada ayam
                                                                                                                                                        2. 50gr daun bayam
                                                                                                                                                        3. 1 buah wortel
                                                                                                                                                        4. 2 lembar keju
                                                                                                                                                        5. 1/2 sdt garam
                                                                                                                                                        6. 1/2 sdt merica
                                                                                                                                                        7. 1/2 std kecap manis dan kecap inggris
                                                                                                                                                        8. tepung panir secukupnya
                                                                                                                                                        9. 2 butir telur
                                                                                                                                                        10. 100gr beras', 
                                                                                                                                                'cara' => 
                                                                                                                                                        '1. Lumuri daging dengan garam, merica, kecap manis dan kecap inggris. Diamkan selama 30 menit
                                                                                                                                                        2. Ambil satu lembar daging ayam tadi dan tata bayam. kecu dan wortel diatasnya
                                                                                                                                                        3. Lumuri dengan tepung panir dan celup kedapam putih telur
                                                                                                                                                        4. Goreng hingga matang kuning kecoklatan'],
            ['nama' => 'Nasi Nugget Ayam Sayur (15 Buah)', 'energi' => 198.7, 'protein' => 7.36, 'lemak' => 5.28, 'karbo' => 29.4,      'bahan' => 
                                                                                                                                                '1. Nasi
                                                                                                                                                2. nugget ayam
                                                                                                                                                3. sayuran (kacang panjang, wortel)
                                                                                                                                                4. saus', 
                                                                                                                                        'cara' => 
                                                                                                                                                '1. Goreng nugget ayam
                                                                                                                                                2. tambahkan nasi dan sayuran
                                                                                                                                                3. aduk dan sajikan.'],
            ['nama' => 'Nasi Bakso Ayam Jamur (2 Porsi)', 'energi' => 519.7, 'protein' => 20.16, 'lemak' => 16.58, 'karbo' => 73.3,     'bahan' => 
                                                                                                                                                '1. 
                                                                                                                                                Nasi
                                                                                                                                                2. bakso ayam
                                                                                                                                                3. jamur
                                                                                                                                                4. bawang
                                                                                                                                                5. kecap', 
                                                                                                                                        'cara' => 
                                                                                                                                                '1. Tumis bakso ayam dan jamur dengan bawang dan kecap
                                                                                                                                                2. tambahkan nasi, aduk dan sajikan.'],
            ['nama' => 'Nasi Dadar Makaroni Sayur (9 Potong)', 'energi' => 249.1, 'protein' => 10.86, 'lemak' => 8.18, 'karbo' => 31.2,         'bahan' => 
                                                                                                                                                        '1. Nasi
                                                                                                                                                        2. dadar
                                                                                                                                                        3. makaroni
                                                                                                                                                        4. sayuran (wortel, kubis)
                                                                                                                                                        5. bumbu', 
                                                                                                                                                'cara' => 
                                                                                                                                                        '1. Gulung nasi dengan dadar
                                                                                                                                                        2. makaroni, dan sayuran
                                                                                                                                                        3. tambahkan bumbu
                                                                                                                                                        4. kukus hingga matang.'],
            ['nama' => 'Nasi Steak Tempe (2 Porsi)', 'energi' => 425.6, 'protein' => 23.86, 'lemak' => 16.78, 'karbo' => 43.9,  'bahan' => 
                                                                                                                                        '1. Nasi
                                                                                                                                        2. steak tempe
                                                                                                                                        3. bawang
                                                                                                                                        4. saus', 
                                                                                                                                'cara' => 
                                                                                                                                        '1. Goreng steak tempe dengan bawang dan saus
                                                                                                                                        2. tambahkan nasi
                                                                                                                                        3. aduk dan sajikan.'],
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
