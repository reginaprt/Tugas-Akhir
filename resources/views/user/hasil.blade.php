@extends('adminlte::page')

@section('title', 'Hasil Akhir Perhitungan')

@section('content_header')
<h1 class="m-0 text-dark">Hasil Akhir Perhitungan</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">Data Balita</div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="id" value="{{$user->id}}" hidden>
                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required {{ $user->name ? 'readonly' : '' }}>
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required {{ $user->jenis_kelamin ? 'readonly' : '' }}>
                        <option>Pilih</option>
                        <option value="L" {{ $user->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $user->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="tinggi_badan" class="col-sm-2 col-form-label">Tinggi Badan</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" required readonly value="{{$user->tinggi_badan}}">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cm</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="berat_badan" class="col-sm-2 col-form-label">Berat Badan</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" class="form-control" id="berat_badan" name="berat_badan" required readonly value="{{$user->berat_badan}}">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Kg</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required value="{{$user->tanggal_lahir}}" {{ $user->tanggal_lahir ? 'readonly' : '' }}>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-form-label">Hasil Perhitungan Berat Badan Ideal (BBI)</div>
                <div class="mb-0" style="color: green">
                    <h5 class="text-center text-bold">
                        @if($user->hasil == 'Under')
                            <span style="color: yellow;">Kekurangan Berat Badan</span>
                        @elseif($user->hasil == 'Normal')
                            <span style="color: green;">Berat Badan Normal</span>
                        @elseif($user->hasil == 'Over')
                            <span style="color: red;">Kelebihan Berat Badan</span>
                        @else
                            Lengkapi Data Dulu
                        @endif
                    </h5>
                </div>
            </div>
            <div class="form-group text-center">
                <a href="{{ route('user.print.hasil') }}" target="_blank" class="btn btn-danger">
                    <i class="fa fa-print"></i>
                    Download PDF
                </a>
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
                            <th class="text-center">Resep</th>
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
                                <td class="text-center">
                                    <a href="#" data-toggle="modal" id="showresep" data-id="{{ $menu['id'] }}" data-target="#resepModal">
                                        Lihat Resep
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    <!-- Modal Resep -->
    <div class="modal fade" id="resepModal" tabindex="-1" aria-labelledby="resepModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resepModalLabel">Resep Menu Makanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="show-nama">Menu Makanan</label>
                        <div id="show-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="show-resep">Resep</label>
                        <div id="show-resep"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function(){
            $(document).on('click','#showresep', function(){

                let id = $(this).data('id');

                $.ajax({
                    type: "get",
                    url: "{{url('/user/ajaxuser/dataRekomen')}}/"+id,
                    dataType: 'json',
                    success: function(res){
                        $('#show-nama').text(res.nama);
                        $('#show-resep').html(res.resep.replace(/\n/g, '<br>'));
                        $('#show-id').text(res.id);
                    },
                });
            });
        });
    </script>
@stop
