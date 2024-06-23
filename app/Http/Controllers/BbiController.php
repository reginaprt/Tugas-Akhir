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

        // Menghitung BMI
        $jadi = $req->get('berat_badan') / (($req->get('tinggi_badan') / 100) ** 2);

        // Menentukan kategori berdasarkan BMI
        if ($jadi < 18.5) {
            $hasil = 'Under';
        } elseif ($jadi >= 18.5 && $jadi < 24.9) {
            $hasil = 'Normal';
        } else {
            $hasil = 'Over';
        }

        $bbi->hasil = $hasil ;

        $bbi->save();

        $notification = array(
            'message' => 'Data Balita Berhasil di Lengkapi',
            'alert-type' => 'success'
        );

        return redirect()->route('user.bbi')->with($notification);
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
