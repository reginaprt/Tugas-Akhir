<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hasil;
use Illuminate\Support\Facades\Auth;
use PDF;

class HasilController extends Controller
{
    // Hasil Index ------------------------------------------------------------------------------------------------------
    public function index()
    {
        $user = Auth::user();

        // Check if berat_badan is null
        if ($user->berat_badan === null) {
            // Redirect back with an error message or handle the error as needed
            return redirect()->back();
        }

        $rekomen = Hasil::where('name', $user->name)->latest()->first();

        // Decode data JSON menjadi array
        if ($rekomen === null) {
            return redirect()->back();
        }
        $resep = json_decode($rekomen->resep, true);

        // Keluarkan data menjadi array sesuai kebutuhan
        $rekomenNormal = $resep['rekomenNormal'];
        $rekomenUnder = $resep['rekomenUnder'];
        $rekomenOver = $resep['rekomenOver'];

        // Variabel untuk menyimpan hasil
        $results = [];

        // Menyimpan data sesuai kebutuhan
        $results['rekomenNormal1'] = $rekomenNormal[0];
        $results['rekomenNormal2'] = $rekomenNormal[1];
        $results['rekomenNormal3'] = $rekomenNormal[2];
        $results['rekomenNormal4'] = $rekomenNormal[3];
        $results['rekomenNormal5'] = $rekomenNormal[4];
        $results['rekomenNormal6'] = $rekomenNormal[5];
        $results['rekomenNormal7'] = $rekomenNormal[6];

        $results['rekomenUnder1'] = $rekomenUnder[0];
        $results['rekomenUnder2'] = $rekomenUnder[1];
        $results['rekomenUnder3'] = $rekomenUnder[2];
        $results['rekomenUnder4'] = $rekomenUnder[3];
        $results['rekomenUnder5'] = $rekomenUnder[4];
        $results['rekomenUnder6'] = $rekomenUnder[5];
        $results['rekomenUnder7'] = $rekomenUnder[6];

        $results['rekomenOver1'] = $rekomenOver[0];
        $results['rekomenOver2'] = $rekomenOver[1];
        $results['rekomenOver3'] = $rekomenOver[2];
        $results['rekomenOver4'] = $rekomenOver[3];
        $results['rekomenOver5'] = $rekomenOver[4];
        $results['rekomenOver6'] = $rekomenOver[5];
        $results['rekomenOver7'] = $rekomenOver[6];

        // dd($results);
        return view('user.hasil', compact('user', 'results'));
    }


    public function print_hasil(){

        $user = Auth::user();
        $rekomen = Hasil::where('name', $user->name)->latest()->first();


        // Decode data JSON menjadi array
        $resep = json_decode($rekomen->resep, true);

        // Keluarkan data menjadi array sesuai kebutuhan
        $rekomenNormal = $resep['rekomenNormal'];
        $rekomenUnder = $resep['rekomenUnder'];
        $rekomenOver = $resep['rekomenOver'];

        // Variabel untuk menyimpan hasil
        $results = [];

        // Menyimpan data sesuai kebutuhan
        $results['rekomenNormal1'] = $rekomenNormal[0];
        $results['rekomenNormal2'] = $rekomenNormal[1];
        $results['rekomenNormal3'] = $rekomenNormal[2];
        $results['rekomenNormal4'] = $rekomenNormal[3];
        $results['rekomenNormal5'] = $rekomenNormal[4];
        $results['rekomenNormal6'] = $rekomenNormal[5];
        $results['rekomenNormal7'] = $rekomenNormal[6];

        $results['rekomenUnder1'] = $rekomenUnder[0];
        $results['rekomenUnder2'] = $rekomenUnder[1];
        $results['rekomenUnder3'] = $rekomenUnder[2];
        $results['rekomenUnder4'] = $rekomenUnder[3];
        $results['rekomenUnder5'] = $rekomenUnder[4];
        $results['rekomenUnder6'] = $rekomenUnder[5];
        $results['rekomenUnder7'] = $rekomenUnder[6];

        $results['rekomenOver1'] = $rekomenOver[0];
        $results['rekomenOver2'] = $rekomenOver[1];
        $results['rekomenOver3'] = $rekomenOver[2];
        $results['rekomenOver4'] = $rekomenOver[3];
        $results['rekomenOver5'] = $rekomenOver[4];
        $results['rekomenOver6'] = $rekomenOver[5];
        $results['rekomenOver7'] = $rekomenOver[6];

        $pdf = PDF::loadView('pdf', ['results' => $results, 'user' => $user]);


        return $pdf->download('hasil-perhitungan.pdf');
    }
}
