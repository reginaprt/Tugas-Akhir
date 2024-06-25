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
            ['kode' => 'C1', 'kriteria' => 'Energi', 'bobot' => 20],
            ['kode' => 'C2', 'kriteria' => 'Protein', 'bobot' => 10],
            ['kode' => 'C3', 'kriteria' => 'Lemak', 'bobot' => 30],
            ['kode' => 'C4', 'kriteria' => 'Karbo', 'bobot' => 40],
        ];

        $normal = [
            ['kode' => 'C1', 'kriteria' => 'Energi', 'bobot' => 40],
            ['kode' => 'C2', 'kriteria' => 'Protein', 'bobot' => 10],
            ['kode' => 'C3', 'kriteria' => 'Lemak', 'bobot' => 20],
            ['kode' => 'C4', 'kriteria' => 'Karbo', 'bobot' => 30],
        ];

        $over = [
            ['kode' => 'C1', 'kriteria' => 'Energi', 'bobot' => 40],
            ['kode' => 'C2', 'kriteria' => 'Protein', 'bobot' => 30],
            ['kode' => 'C3', 'kriteria' => 'Lemak', 'bobot' => 10],
            ['kode' => 'C4', 'kriteria' => 'Karbo', 'bobot' => 20],
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

        // Inisialisasi array untuk rekomendasi
        $rekomenNormal1 = [];
        $rekomenNormal2 = [];
        $rekomenNormal3 = [];
        $rekomenNormal4 = [];
        $rekomenNormal5 = [];
        $rekomenNormal6 = [];
        $rekomenNormal7 = [];

        $rekomenUnder1 = [];
        $rekomenUnder2 = [];
        $rekomenUnder3 = [];
        $rekomenUnder4 = [];
        $rekomenUnder5 = [];
        $rekomenUnder6 = [];
        $rekomenUnder7 = [];

        $rekomenOver1 = [];
        $rekomenOver2 = [];
        $rekomenOver3 = [];
        $rekomenOver4 = [];
        $rekomenOver5 = [];
        $rekomenOver6 = [];
        $rekomenOver7 = [];

        // Mengisi array rekomendasi
        for ($i = 0; $i < 3; $i++) {
            $rekomenNormal1[] = $hasilNormal[$i * 7];
            $rekomenNormal2[] = $hasilNormal[$i * 7 + 1];
            $rekomenNormal3[] = $hasilNormal[$i * 7 + 2];
            $rekomenNormal4[] = $hasilNormal[$i * 7 + 3];
            $rekomenNormal5[] = $hasilNormal[$i * 7 + 4];
            $rekomenNormal6[] = $hasilNormal[$i * 7 + 5];
            $rekomenNormal7[] = $hasilNormal[$i * 7 + 6];

            $rekomenUnder1[] = $hasilUnder[$i * 7];
            $rekomenUnder2[] = $hasilUnder[$i * 7 + 1];
            $rekomenUnder3[] = $hasilUnder[$i * 7 + 2];
            $rekomenUnder4[] = $hasilUnder[$i * 7 + 3];
            $rekomenUnder5[] = $hasilUnder[$i * 7 + 4];
            $rekomenUnder6[] = $hasilUnder[$i * 7 + 5];
            $rekomenUnder7[] = $hasilUnder[$i * 7 + 6];

            $rekomenOver1[] = $hasilOver[$i * 7];
            $rekomenOver2[] = $hasilOver[$i * 7 + 1];
            $rekomenOver3[] = $hasilOver[$i * 7 + 2];
            $rekomenOver4[] = $hasilOver[$i * 7 + 3];
            $rekomenOver5[] = $hasilOver[$i * 7 + 4];
            $rekomenOver6[] = $hasilOver[$i * 7 + 5];
            $rekomenOver7[] = $hasilOver[$i * 7 + 6];
        }

        dd($hasilNormal);
        $resep = [
            'rekomenNormal' => [
                $rekomenNormal1, $rekomenNormal2, $rekomenNormal3, $rekomenNormal4, $rekomenNormal5, $rekomenNormal6, $rekomenNormal7
            ],
            'rekomenUnder' => [
                $rekomenUnder1, $rekomenUnder2, $rekomenUnder3, $rekomenUnder4, $rekomenUnder5, $rekomenUnder6, $rekomenUnder7
            ],
            'rekomenOver' => [
                $rekomenOver1, $rekomenOver2, $rekomenOver3, $rekomenOver4, $rekomenOver5, $rekomenOver6, $rekomenOver7
            ]
        ];

        // Simpan ke database hanya jika tidak ada data yang sama
        $existingData = Hasil::where('berat_badan', $user->berat_badan)
                                    ->where('tinggi_badan', $user->tinggi_badan)
                                    ->first();

        if (!$existingData) {
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


        return view('user.check',
            compact('user','data', 'hasilOver',
            'rekomenNormal1', 'rekomenNormal2', 'rekomenNormal3', 'rekomenNormal4', 'rekomenNormal5', 'rekomenNormal6', 'rekomenNormal7',
            'rekomenUnder1', 'rekomenUnder2', 'rekomenUnder3', 'rekomenUnder4', 'rekomenUnder5', 'rekomenUnder6', 'rekomenUnder7',
            'rekomenOver1', 'rekomenOver2', 'rekomenOver3', 'rekomenOver4', 'rekomenOver5', 'rekomenOver6', 'rekomenOver7'));
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
