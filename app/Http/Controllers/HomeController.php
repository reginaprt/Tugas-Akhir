<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hasil;

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
        $beratBadann = Hasil::where('name', $user->name)->pluck('tinggi_badan');

        $tinggiBadan = $tinggiBadann->toArray();
        $beratBadan = $beratBadann->toArray();


        $data = [];
        foreach ($tinggiBadan as $index => $tinggi) {
            $data[] = [
                'tinggi' => $tinggi,
                'berat' => $beratBadan[$index]
            ];
        }

        $actualData = [50, 60, 70, 80, 90]; // Contoh data nilai aktual
        $targetData = [55, 65, 75, 85, 95]; // Contoh data nilai target

        return view('home', compact('user', 'data', 'actualData', 'targetData'));
    }
}
