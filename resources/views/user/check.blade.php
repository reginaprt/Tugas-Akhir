@extends('adminlte::page')

@section('title', 'Cek Rekomendasi Menu Makanan')

@section('content_header')
<h3 class="m-0 text-dark"></h3>
@stop

@section('content')
    @php
        $rekomendasi = [];

        switch ($user->hasil) {
            case 'Under':
                $rekomendasi = [$rekomenUnder1, $rekomenUnder2, $rekomenUnder3];
                break;
            case 'Normal':
                $rekomendasi = [$rekomenNormal1, $rekomenNormal2, $rekomenNormal3];
                break;
            case 'Over':
                $rekomendasi = [$rekomenOver1, $rekomenOver2, $rekomenOver3];
                break;
            default:
                break;
        }
    @endphp

    @foreach ($rekomendasi as $index => $rekomendasiGroup)
        <div class="card card-secondary">
            <div class="card-header">Menu Rekomendasi {{ $index + 1 }}</div>
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
                                <td>{{ $menu['Name'] }}</td>
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
