<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BbiController extends Controller
{
    // bbi Index ------------------------------------------------------------------------------------------------------
    public function index()
    {
        $bbis = User::all();
        $user = Auth::user();
        return view('user.bbi', compact('bbis', 'user'));
    }

    // bbi Get -------------------------------------------------------------------------------------------------------
    public function dataBbi($id)
    {
        $bbi = User::find($id);

        return response()->json($bbi);
    }

    // bbi Update ----------------------------------------------------------------------------------------------------
    public function update(Request $req)
    {
        $bbi = User::find($req->get('id'));

        if (!$bbi) {
            return redirect()->route('user.bbi')->with('error', 'Data BBI not found');
        }

        $validated = $req->validate([
            'name' => 'sometimes|required|max:50',
            'jenis_kelamin' => 'sometimes|required',
            'tanggal_lahir' => 'sometimes|required|date',
            'berat_badan' => 'sometimes|required|numeric',
            'tinggi_badan' => 'sometimes|required|numeric',
        ]);

        $bbi->name = $req->get('name');
        $bbi->jenis_kelamin = $req->get('jenis_kelamin');
        $bbi->tanggal_lahir = $req->get('tanggal_lahir');
        $bbi->berat_badan = $req->get('berat_badan');
        $bbi->tinggi_badan = $req->get('tinggi_badan');

        $tanggal_lahir = $req->get('tanggal_lahir');
        $tahun_lahir = date('Y', strtotime($tanggal_lahir));
        $tahun_sekarang = date('Y');
        $usia = $tahun_sekarang - $tahun_lahir;

        $jenisKelamin = $req->input('jenis_kelamin') == 'L' ? 'laki-laki' : 'perempuan';
        $beratBadan = $req->input('berat_badan');

        $status = $this->determineStatus($usia, $jenisKelamin, $beratBadan);

        $bbi->hasil = $status ;

        $bbi->save();

        $notification = array(
            'message' => 'Data Balita Berhasil di Lengkapi',
            'alert-type' => 'success'
        );

        return redirect()->route('user.bbi')->with($notification);
    }

    private function determineStatus($usia, $jenisKelamin, $beratBadan)
    {
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

        if (!isset($rangeBeratBadan[$jenisKelamin][$usia])) {
            return 'Data tidak valid';
        }

        $rangeBerat = $rangeBeratBadan[$jenisKelamin][$usia];

        if ($beratBadan < $rangeBerat['min']) {
            return 'Under';
        } elseif ($beratBadan > $rangeBerat['max']) {
            return 'Over';
        } else {
            return 'Normal';
        }
    }

    // bbi Delete ----------------------------------------------------------------------------------------------------
    public function delete($id)
    {
        $bbi = User::find($id);

        if (!$bbi) {
            return redirect()->route('user.bbi')->with('error', 'Data BBI not found');
        }

        $bbi->delete();

        $success = true;
        $message = "Data BBI Berhasil di Hapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
