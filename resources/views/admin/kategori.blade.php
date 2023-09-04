@extends('adminlte::page')

@section('title', 'Penasi Page')

@section('content_header')
    <h1>Data Kategori</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
                <div class="card-header">{{ __('Pengelolaan Kategori')}}</div>
            <div class="card-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahKategoriModal"><i class="fa fa-plus"></i>Tambah Data</button>                
                <hr>
                <table id="table-data" class="table table-bordered table-responsive">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>JENIS</th>
                            <th>KATEGORI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->jenis}}</td>
                                <td>{{$data->kategori}}</td>
                                <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-kategori" class="btn btn-success" data-toggle="modal" data-target="#editKategoriModal" data-id="{{ $data->id }}">Edit</button>
                                        <button class="btn btn-danger" onclick="deleteConfirmation('{{$data->id}}','{{$data->kategori}}')">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Tambah Data Kategori
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.kategori.submit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="jenis">Silahkan Pilih Jenis</label>
                            <select class="custom-select jenis" id="jenis" name="jenis" required>
                                <option value="">--Jenis--</option>
                                <option value="Pengaduan">Pengaduan</option>
                                <option value="Aspirasi">Aspirasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Tanggapan</label>
                            <input type="text" name="kategori" id="kategori" class="form-control" required/>
                        </div>                                
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Edit Data Kategori
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.kategori.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="jenis">Silahkan Pilih Jenis</label>
                            <select class="custom-select jenis" id="edit-jenis" name="jenis">
                                <option value="">--Jenis--</option>
                                <option value="Pengaduan">Pengaduan</option>
                                <option value="Aspirasi">Aspirasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Tanggapan</label>
                            <input type="text" name="kategori" id="edit-kategori" class="form-control" required/>
                        </div>                  
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="edit-id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@yield('adminlte_js')

@section('js')
<script>
    
    //Modal Edit
    $(function(){
        $(document).on('click','#btn-edit-kategori', function(){
            let id = $(this).data('id');
            alert(id);
            console.log(id);
            $.ajax({
                type: "get",
                url: "{{url('admin/ajaxadmin/dataKategori')}}/"+id,
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    console.log(res.jenis);
                    // $('#edit-name').val(res.name);
                    $('#edit-id').val(res.id);
                    $('#edit-jenis option[value="'+res.jenis+'"]').attr("selected", "selected");
                    $('#edit-kategori').val(res.kategori);  
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

    //Delete
    function deleteConfirmation(id, kategori){
        Swal.fire({
            title: "Hapus?",
            icon: 'warning',
            text: "Apakah anda yakin akan menghapus data kategori " + kategori +" ?!",
            showCancelButton: !0,
            confirmButtonText: "Ya, Lakukan!",
            cancelButtonText: "Tidak, batalkan!", 
            reverseButtons: !0
        }).then(function (e){
            if(e.value === true){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'DELETE',
                    url: "kategori/delete/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'json',
                    success: function(results){
                        if(results.success===true){
                            swal.fire("Done!", results.message, "success");
                            setTimeout(function(){
                                location.reload();
                            },1000);
                        }else{
                            swal.fire("Error!", results.message, "error");
                        }
                    }
                });
            }else{
                e.dismiss;
            }
        }, function(dismiss){
            return false;
        });
    }
</script>
@endsection