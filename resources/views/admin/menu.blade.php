@extends('adminlte::page')

@section('title', 'Kelola Menu')

@section('content_header')
<h1 class="m-0 text-dark">Kelola Menu Makanan</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">Data Menu</div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                    Tambah Menu
                </button>
                <div>
                    <button class="btn btn-info">Export Data</button>
                    <button class="btn btn-success">Import Data</button>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="table-data" class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nama Makanan</th>
                            <th class="text-center">Energi</th>
                            <th class="text-center">Protein</th>
                            <th class="text-center">Lemak</th>
                            <th class="text-center">Karbo</th>
                            <th class="text-center">Resep</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                        <tr>
                            <td class="text-center">{{ $menu->id }}</td>
                            <td>{{ $menu->nama }}</td>
                            <td class="text-center">{{ $menu->energi }}</td>
                            <td class="text-center">{{ $menu->protein }}</td>
                            <td class="text-center">{{ $menu->lemak }}</td>
                            <td class="text-center">{{ $menu->karbo }}</td>
                            <td class="text-center">
                                <a href="#" data-toggle="modal" id="showresep" data-id="{{ $menu->id }}" data-target="#resepModal">
                                    Lihat Resep
                                </a>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-secondary" id="btn-edit-menu" data-id="{{ $menu->id }}" data-toggle="modal" data-target="#editModal">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger"  onclick="deleteConfirmation('{{$menu->id}}' , '{{$menu->nama}}' )">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Menu Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('admin.menu.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Makanan</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="energi">Energi</label>
                            <input type="number" class="form-control" id="energi" name="energi" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="protein">Protein</label>
                            <input type="number" class="form-control" id="protein" name="protein" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="lemak">Lemak</label>
                            <input type="number" class="form-control" id="lemak" name="lemak" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="karbo">Karbo</label>
                            <input type="number" class="form-control" id="karbo" name="karbo" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bahan">Bahan-bahan</label>
                        <textarea class="form-control" id="bahan" name="bahan" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cara">Cara Membuat</label>
                        <textarea class="form-control" id="cara" name="cara" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.menu.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-nama">Nama Makanan</label>
                            <input type="text" class="form-control" id="edit-id" name="id" hidden>
                            <input type="text" class="form-control" id="edit-nama" name="nama" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="edit-energi">Energi</label>
                                <input type="number" class="form-control" id="edit-energi" name="energi" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="edit-protein">Protein</label>
                                <input type="number" class="form-control" id="edit-protein" name="protein" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="edit-lemak">Lemak</label>
                                <input type="number" class="form-control" id="edit-lemak" name="lemak" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="edit-karbo">Karbo</label>
                                <input type="number" class="form-control" id="edit-karbo" name="karbo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit-bahan">Bahan-bahan</label>
                            <textarea class="form-control" id="edit-bahan" name="bahan" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-cara">Cara Membuat</label>
                            <textarea class="form-control" id="edit-cara" name="cara" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                        <label for="show-bahan">Bahan-bahan</label>
                        <div id="show-bahan"></div>
                    </div>
                    <div class="form-group">
                        <label for="show-cara">Cara Membuat</label>
                        <div id="show-cara"></div>
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
            $(document).on('click','#btn-edit-menu', function(){

                let id = $(this).data('id');

                $.ajax({
                    type: "get",
                    url: "{{url('/admin/ajaxadmin/dataMenu')}}/"+id,
                    dataType: 'json',
                    success: function(res){
                        $('#edit-nama').val(res.nama);
                        $('#edit-energi').val(res.energi);
                        $('#edit-protein').val(res.protein);
                        $('#edit-lemak').val(res.lemak);
                        $('#edit-karbo').val(res.karbo);
                        $('#edit-bahan').val(res.bahan);
                        $('#edit-cara').val(res.cara);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        $(function(){
            $(document).on('click','#showresep', function(){

                let id = $(this).data('id');

                $.ajax({
                    type: "get",
                    url: "{{url('/admin/ajaxadmin/dataMenu')}}/"+id,
                    dataType: 'json',
                    success: function(res){
                        $('#show-nama').text(res.nama);
                        $('#show-bahan').html(res.bahan.replace(/\n/g, '<br>'));
                        $('#show-cara').html(res.cara.replace(/\n/g, '<br>'));
                        $('#show-id').text(res.id);
                    },
                });
            });
        });

        function deleteConfirmation(id,nama) {
            swal.fire({
                title: "Hapus?",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus menu " +nama+ " ini ?!",
                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",

            }).then (function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "menus/delete/" + id,
                        data: {_token: CSRF_TOKEN},
                        dataType: 'JSON',
                        success: function (results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                setTimeout(function(){
                                    location.reload();
                                },1000);
                            } else {
                                 swal.fire("Error!", results.message, "error");
                            }
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                 return false;
            })
        }
    </script>
@stop
