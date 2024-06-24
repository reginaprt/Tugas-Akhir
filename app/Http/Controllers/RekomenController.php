<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Menu;

class RekomenController extends Controller
{
    // Rekomen Index ---------------------------------------------------------------------------------------------------
    public function index()
    {
        $user = Auth::user();
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
                'Name' => $menu->nama,
                'Energi' => $menu->energi,
                'Protein' => $menu->protein,
                'Lemak' => $menu->lemak,
                'Karbo' => $menu->karbo,
                'resep' => $menu->resep,
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

        $rekomenNormal1 = array_slice($hasilNormal, 0, 3);
        $rekomenNormal2 = array_slice($hasilNormal, 3, 3);
        $rekomenNormal3 = array_slice($hasilNormal, 6, 3);
        // compact('rekomenNormal1', 'rekomenNormal2', 'rekomenNormal3');

        return view('user.check', compact('user','data', 'hasilOver', 'hasilNormal', 'hasilOver', 'rekomenNormal1', 'rekomenNormal2', 'rekomenNormal3'));
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

    // // Rekomen Check ---------------------------------------------------------------------------------------------------
    // public function check()
    // {
    //     $menu = Menu::all();
    //     $user = Auth::user();

    //     dd($menu);

    //     $under = [
    //         ['kode' => 'C1', 'kriteria' => 'Energi',    'bobot' => 20],
    //         ['kode' => 'C2', 'kriteria' => 'Protein',   'bobot' => 10],
    //         ['kode' => 'C3', 'kriteria' => 'Lemak',     'bobot' => 30],
    //         ['kode' => 'C4', 'kriteria' => 'Karbo',     'bobot' => 40],
    //     ];

    //     $normal = [
    //         ['kode' => 'C1', 'kriteria' => 'Energi',    'bobot' => 40],
    //         ['kode' => 'C2', 'kriteria' => 'Protein',   'bobot' => 10],
    //         ['kode' => 'C3', 'kriteria' => 'Lemak',     'bobot' => 20],
    //         ['kode' => 'C4', 'kriteria' => 'Karbo',     'bobot' => 30],
    //     ];

    //     $over = [
    //         ['kode' => 'C1', 'kriteria' => 'Energi',    'bobot' => 40],
    //         ['kode' => 'C2', 'kriteria' => 'Protein',   'bobot' => 30],
    //         ['kode' => 'C3', 'kriteria' => 'Lemak',     'bobot' => 10],
    //         ['kode' => 'C4', 'kriteria' => 'Karbo',     'bobot' => 20],
    //     ];



    // }


}
