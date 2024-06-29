<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hasil;
use App\Models\Menu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $tinggiBadann = Hasil::where('name', $user->name)->pluck('tinggi_badan');
        $beratBadann = Hasil::where('name', $user->name)->pluck('berat_badan');

        $tinggiBadan = $tinggiBadann->toArray();
        $data = $beratBadann->toArray();

        // Kategori untuk frekuensi
        $categories = [];
        for ($i = 0; $i < count($data); $i++) {
            $categories[] = ($i + 1);
        }

        $rangeBeratBadan = [
            'laki-laki' => [
                1 => ['min' => 7.7, 'max' => 12.0],
                2 => ['min' => 9.7, 'max' => 15.3],
                3 => ['min' => 11.3, 'max' => 18.3],
                4 => ['min' => 12.7, 'max' => 21.2],
                5 => ['min' => 14.1, 'max' => 24.2],
                6 => ['min' => 15.9, 'max' => 27.1],
            ],
            'perempuan' => [
                1 => ['min' => 7.0, 'max' => 11.5],
                2 => ['min' => 9.0, 'max' => 14.8],
                3 => ['min' => 10.8, 'max' => 18.1],
                4 => ['min' => 12.3, 'max' => 21.5],
                5 => ['min' => 13.7, 'max' => 24.9],
                6 => ['min' => 15.3, 'max' => 26.8],
            ]
        ];

        $jumlahMenu = Menu::count();

        $usia = NULL;
        $rangeMin = NULL;
        $rangeMax = NULL;
        $rangeMinToleran = NULL;
        $rangeMaxToleran = NULL;


        if($user->tanggal_lahir){
            $tahun_lahir = date('Y', strtotime($user->tanggal_lahir));
            $tahun_sekarang = date('Y');
            $usia = $tahun_sekarang - $tahun_lahir;

            $jenisKelamin = $user->jenis_kelamin == 'L' ? 'laki-laki' : 'perempuan';
            $rangeMin = $rangeBeratBadan[$jenisKelamin][$usia]['min'];
            $rangeMax = $rangeBeratBadan[$jenisKelamin][$usia]['max'];

        }

        $rangeMinToleran = max(0, $rangeMin - 10);
        $rangeMaxToleran = $rangeMax + 10;

        return view('home', compact('user', 'data', 'usia', 'jumlahMenu', 'categories', 'rangeMin', 'rangeMax', 'rangeMinToleran', 'rangeMaxToleran'));
    }
}
