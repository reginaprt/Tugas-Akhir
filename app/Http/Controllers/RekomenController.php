<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Hasil;
use App\Models\Menu;

class RekomenController extends Controller
{
    // Rekomen Index ---------------------------------------------------------------------------------------------------
    public function index()
    {
        $user = Auth::user();
        if ($user->berat_badan === null) {
            return redirect()->back();
        }
        return view('user.rekomendasi', compact('user'));
    }

    // Rekomen Get -----------------------------------------------------------------------------------------------------
    public function dataRekomen($id)
    {
        $rekomen = Menu::find($id);

        return response()->json($rekomen);
    }

    // Rekomen Check ---------------------------------------------------------------------------------------------------
    public function check()
    {
        $user = Auth::user();
        $menus = Menu::all();

        $data = [];

        foreach ($menus as $menu) {
            $data[] = [
                'id' => $menu->id,
                'Nama' => $menu->nama,
                'Energi' => $menu->energi,
                'Protein' => $menu->protein,
                'Lemak' => $menu->lemak,
                'Karbo' => $menu->karbo,
                'Bahan' => $menu->bahan,
                'Cara' => $menu->cara,
            ];
        }

        // Kriteria dan bobot untuk tiga kategori: under, normal, over
        $under = [
            ['kode' => 'C1', 'kriteria' => 'Energi', 'bobot' => 21],
            ['kode' => 'C2', 'kriteria' => 'Protein', 'bobot' => 28],
            ['kode' => 'C3', 'kriteria' => 'Lemak', 'bobot' => 28],
            ['kode' => 'C4', 'kriteria' => 'Karbo', 'bobot' => 21],
        ];

        $normal = [
            ['kode' => 'C1', 'kriteria' => 'Energi', 'bobot' => 25],
            ['kode' => 'C2', 'kriteria' => 'Protein', 'bobot' => 25],
            ['kode' => 'C3', 'kriteria' => 'Lemak', 'bobot' => 25],
            ['kode' => 'C4', 'kriteria' => 'Karbo', 'bobot' => 23],
        ];

        $over = [
            ['kode' => 'C1', 'kriteria' => 'Energi', 'bobot' => 30],
            ['kode' => 'C2', 'kriteria' => 'Protein', 'bobot' => 20],
            ['kode' => 'C3', 'kriteria' => 'Lemak', 'bobot' => 20],
            ['kode' => 'C4', 'kriteria' => 'Karbo', 'bobot' => 30],
        ];

        // Menghitung ranking menggunakan metode TOPSIS
        $underRanking = $this->calculateTopsis($data, $under);
        $normalRanking = $this->calculateTopsis($data, $normal);
        $overRanking = $this->calculateTopsis($data, $over);

        // Mengurutkan data menu berdasarkan indeks
        $hasilUnder = [];
        foreach ($underRanking as $index => $score) {
            $hasilUnder[$index] = $data[$index];
        }
        $hasilNormal = [];
        foreach ($normalRanking as $index => $score) {
            $hasilNormal[$index] = $data[$index];
        }
        $hasilOver = [];
        foreach ($overRanking as $index => $score) {
            $hasilOver[$index] = $data[$index];
        }


        // Membuat array baru untuk menyimpan indeks
        $indexArrayUnder = array_keys($hasilUnder);
        $arrayUnder = [];
        foreach ($indexArrayUnder as $index) {
            if (isset($hasilUnder[$index])) {
                $arrayUnder[] = $hasilUnder[$index];
            }
        }
        $indexArrayNormal = array_keys($hasilNormal);
        $arrayNormal = [];
        foreach ($indexArrayNormal as $index) {
            if (isset($hasilNormal[$index])) {
                $arrayNormal[] = $hasilNormal[$index];
            }
        }
        $indexArrayOver = array_keys($hasilOver);
        $arrayOver = [];
        foreach ($indexArrayOver as $index) {
            if (isset($hasilOver[$index])) {
                $arrayOver[] = $hasilOver[$index];
            }
        }

        // Inisialisasi array baru
        $rekomenUnder = [
            'rekomenUnder1' => [], 'rekomenUnder2' => [], 'rekomenUnder3' => [], 'rekomenUnder4' => [], 'rekomenUnder5' => [], 'rekomenUnder6' => [], 'rekomenUnder7' => [],
        ];
        $rekomenNormal = [
            'rekomenNormal1' => [], 'rekomenNormal2' => [], 'rekomenNormal3' => [], 'rekomenNormal4' => [], 'rekomenNormal5' => [], 'rekomenNormal6' => [], 'rekomenNormal7' => [],
        ];
        $rekomenOver = [
            'rekomenOver1' => [], 'rekomenOver2' => [], 'rekomenOver3' => [], 'rekomenOver4' => [], 'rekomenOver5' => [], 'rekomenOver6' => [], 'rekomenOver7' => [],
        ];

        // Mengisi array baru
        foreach ($arrayUnder as $key => $value) {
            $index = $key % 7;
            $arrayName = 'rekomenUnder' . ($index + 1);
            $rekomenUnder[$arrayName][] = $value;
        }
        foreach ($arrayNormal as $key => $value) {
            $index = $key % 7;
            $arrayName = 'rekomenNormal' . ($index + 1);
            $rekomenNormal[$arrayName][] = $value;
        }
        foreach ($arrayOver as $key => $value) {
            $index = $key % 7;
            $arrayName = 'rekomenOver' . ($index + 1);
            $rekomenOver[$arrayName][] = $value;
        }

        // Slice data sehingga setiap hasil hanya memiliki 3 data teratas
        foreach ($rekomenUnder as $key => $value) {
            $rekomenUnder[$key] = array_slice($value, 0, 3);
        }

        foreach ($rekomenNormal as $key => $value) {
            $rekomenNormal[$key] = array_slice($value, 0, 3);
        }

        foreach ($rekomenOver as $key => $value) {
            $rekomenOver[$key] = array_slice($value, 0, 3);
        }

        // dd($rekomenOver);

        $resep = [
            'rekomenNormal' => [
                $rekomenNormal['rekomenNormal1'], $rekomenNormal['rekomenNormal2'], $rekomenNormal['rekomenNormal3'], $rekomenNormal['rekomenNormal4'], $rekomenNormal['rekomenNormal5'], $rekomenNormal['rekomenNormal6'], $rekomenNormal['rekomenNormal7']
            ],
            'rekomenUnder' => [
                $rekomenUnder['rekomenUnder1'], $rekomenUnder['rekomenUnder2'], $rekomenUnder['rekomenUnder3'], $rekomenUnder['rekomenUnder4'], $rekomenUnder['rekomenUnder5'], $rekomenUnder['rekomenUnder6'], $rekomenUnder['rekomenUnder7']
            ],
            'rekomenOver' => [
                $rekomenOver['rekomenOver1'], $rekomenOver['rekomenOver2'], $rekomenOver['rekomenOver3'], $rekomenOver['rekomenOver4'], $rekomenOver['rekomenOver5'], $rekomenOver['rekomenOver6'], $rekomenOver['rekomenOver7']
            ]
        ];


        // Ambil data terakhir dari database
        $lastHasil = Hasil::orderBy('created_at', 'desc')->first();

        // Bandingkan data terakhir dengan data yang akan diinputkan
        $isSame = $lastHasil &&
                  $lastHasil->name == $user->name &&
                  $lastHasil->jenis_kelamin == $user->jenis_kelamin &&
                  $lastHasil->tanggal_lahir == $user->tanggal_lahir &&
                  $lastHasil->berat_badan == $user->berat_badan &&
                  $lastHasil->tinggi_badan == $user->tinggi_badan &&
                  $lastHasil->hasil == $user->hasil &&
                  $lastHasil->resep == json_encode($resep);

        if (!$isSame) {
            // Data tidak sama, maka simpan
            $hasil = new Hasil();

            $hasil->name = $user->name;
            $hasil->jenis_kelamin = $user->jenis_kelamin;
            $hasil->tanggal_lahir = $user->tanggal_lahir;
            $hasil->berat_badan = $user->berat_badan;
            $hasil->tinggi_badan = $user->tinggi_badan;
            $hasil->hasil = $user->hasil;
            $hasil->resep = json_encode($resep); // Simpan sebagai JSON

            $hasil->save();
        }

        // dd($resep);

        return view('user.check', compact('user','data', 'hasilOver', 'resep', 'rekomenNormal', 'rekomenUnder', 'rekomenOver'));
    }

    private function calculateTopsis($data, $criteria)
    {
        $normalizedMatrix = $this->normalizeMatrix($data, $criteria);
        $weightedMatrix = $this->weightMatrix($normalizedMatrix, $criteria);
        $idealSolutions = $this->calculateIdealSolutions($weightedMatrix);
        $separationMeasures = $this->calculateSeparationMeasures($weightedMatrix, $idealSolutions);
        $relativeCloseness = $this->calculateRelativeCloseness($separationMeasures);

        return $this->rankAlternatives($relativeCloseness);
    }

    private function normalizeMatrix($data, $criteria)
    {
        $normalizedMatrix = [];
        $columns = ['Energi', 'Protein', 'Lemak', 'Karbo'];

        // Menghitung nilai akar dari jumlah kuadrat tiap kolom
        $columnSums = array_reduce($data, function ($carry, $item) use ($columns) {
            foreach ($columns as $col) {
                $carry[$col] = ($carry[$col] ?? 0) + pow($item[$col], 2);
            }
            return $carry;
        }, []);

        foreach ($columnSums as $key => $sum) {
            $columnSums[$key] = sqrt($sum);
        }

        // Normalisasi matriks
        foreach ($data as $row) {
            $normalizedRow = [];
            foreach ($columns as $col) {
                $normalizedRow[$col] = $row[$col] / $columnSums[$col];
            }
            $normalizedMatrix[] = $normalizedRow;
        }

        return $normalizedMatrix;
    }

    private function weightMatrix($normalizedMatrix, $criteria)
    {
        $weightedMatrix = [];
        $columns = ['Energi', 'Protein', 'Lemak', 'Karbo'];
        $weights = array_column($criteria, 'bobot');

        foreach ($normalizedMatrix as $row) {
            $weightedRow = [];
            foreach ($columns as $index => $col) {
                $weightedRow[$col] = $row[$col] * $weights[$index];
            }
            $weightedMatrix[] = $weightedRow;
        }

        return $weightedMatrix;
    }

    private function calculateIdealSolutions($weightedMatrix)
    {
        $idealSolutions = ['positive' => [], 'negative' => []];
        $columns = ['Energi', 'Protein', 'Lemak', 'Karbo'];

        foreach ($columns as $col) {
            $columnValues = array_column($weightedMatrix, $col);
            $idealSolutions['positive'][$col] = max($columnValues);
            $idealSolutions['negative'][$col] = min($columnValues);
        }

        return $idealSolutions;
    }

    private function calculateSeparationMeasures($weightedMatrix, $idealSolutions)
    {
        $separationMeasures = ['positive' => [], 'negative' => []];
        $columns = ['Energi', 'Protein', 'Lemak', 'Karbo'];

        foreach ($weightedMatrix as $row) {
            $positiveSum = 0;
            $negativeSum = 0;

            foreach ($columns as $col) {
                $positiveSum += pow($row[$col] - $idealSolutions['positive'][$col], 2);
                $negativeSum += pow($row[$col] - $idealSolutions['negative'][$col], 2);
            }

            $separationMeasures['positive'][] = sqrt($positiveSum);
            $separationMeasures['negative'][] = sqrt($negativeSum);
        }

        return $separationMeasures;
    }

    private function calculateRelativeCloseness($separationMeasures)
    {
        $relativeCloseness = [];

        foreach ($separationMeasures['positive'] as $index => $value) {
            $relativeCloseness[$index] = $separationMeasures['negative'][$index] / ($separationMeasures['negative'][$index] + $value);
        }

        return $relativeCloseness;
    }

    private function rankAlternatives($relativeCloseness)
    {
        arsort($relativeCloseness);
        return $relativeCloseness;
    }
}
