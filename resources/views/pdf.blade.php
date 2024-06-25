<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <style>
        /* Style untuk card */
        .card {
            margin-bottom: 1rem;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Style untuk table */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        /* Style untuk form-group */
        .form-group {
            margin-bottom: 1rem;
        }

        .col-form-label {
            padding-top: calc(0.375rem + 1px);
            padding-bottom: calc(0.375rem + 1px);
            margin-bottom: 0;
            font-size: inherit;
            line-height: 1.5;
        }

        /* Style untuk mb-0 */
        .mb-0 {
            margin-bottom: 0 !important;
        }

        /* Style untuk text-center */
        .text-center {
            text-align: center !important;
        }

        /* Style untuk text-bold */
        .text-bold {
            font-weight: bold;
        }

        /* Warna teks hijau */
        .text-green {
            color: green;
        }

        /* Style untuk table-responsive */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Penyesuaian untuk card-secondary */
        .card-secondary {
            margin-bottom: 1rem;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

    </style>
</head>
<body>
    <div class="card card-primary">
        <div class="card-header">Data Balita</div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama</th>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <th>Tinggi Badan</th>
                    <td>{{$user->tinggi_badan}} cm</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{$user->tanggal_lahir}}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{$user->jenis_kelamin}}</td>
                </tr>
                <tr>
                    <th>Berat Badan</th>
                    <td>{{$user->berat_badan}} kg</td>
                </tr>
            </table>
            <div class="form-group text-center">
                <div class="col-form-label">Hasil Perhitungan Berat Badan Ideal (BBI)</div>
                <div class="mb-0" style="color: green">
                <h5 class="text-bold">
                    @if($user->hasil == 'Under')
                    Kekurangan Berat Badan
                    @elseif($user->hasil == 'Normal')
                        Berat Badan Normal
                    @elseif($user->hasil == 'Over')
                        Kelebihan Berat Badan
                        @else
                        Lengkapi Data Dulu
                        @endif
                    </h5>
                </div>
            </div>
        </div>
    </div>
    @php
        $rekomendasi = [];

        switch ($user->hasil) {
            case 'Under':
                $rekomendasi = [$results['rekomenUnder1'], $results['rekomenUnder2'], $results['rekomenUnder3'], $results['rekomenUnder4'], $results['rekomenUnder5'], $results['rekomenUnder6'], $results['rekomenUnder7']];
                break;
            case 'Normal':
                $rekomendasi = [$results['rekomenNormal1'], $results['rekomenNormal2'], $results['rekomenNormal3'], $results['rekomenNormal4'], $results['rekomenNormal5'], $results['rekomenNormal6'], $results['rekomenNormal7']];
                break;
            case 'Over':
                $rekomendasi = [$results['rekomenOver1'], $results['rekomenOver2'], $results['rekomenOver3'], $results['rekomenOver4'], $results['rekomenOver5'], $results['rekomenOver6'], $results['rekomenOver7']];
                break;
            default:
                break;
        }
    @endphp

    @foreach ($rekomendasi as $index => $rekomendasiGroup)
        <div class="card card-secondary">
            <div class="card-header">Rekomendasi Hari {{ ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'][$index] }}</div>
            <div class="table-responsive">
                <table class="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Menu</th>
                            <th class="text-center">Energi (kkal)</th>
                            <th class="text-center">Protein (g)</th>
                            <th class="text-center">Lemak (g)</th>
                            <th class="text-center">Karbo (g)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekomendasiGroup as $menu)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $menu['Nama'] }}</td>
                                <td class="text-center">{{ $menu['Energi'] }}</td>
                                <td class="text-center">{{ $menu['Protein'] }}</td>
                                <td class="text-center">{{ $menu['Lemak'] }}</td>
                                <td class="text-center">{{ $menu['Karbo'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
    @foreach ($rekomendasi as $index => $rekomendasiGroup)
    <div class="card card-secondary">
        <div class="card-header">Rekomendasi Hari {{ ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'][$index] }}</div>

        @foreach ($rekomendasiGroup as $menu)
            <div class="card-body">
                <div class="card card-secondary">
                    <div class="card-header">Resep Menu Makanan {{ $loop->iteration }}</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>{{ $menu['Nama'] }}</td>
                            </tr>
                            <tr>
                                <td>Bahan-bahan</td>
                                <td>{{ $menu['Bahan'] }}</td>
                            </tr>
                            <tr>
                                <td>Cara Memasak</td>
                                <td>{{ $menu['Cara'] }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endforeach

</body>
</html>
