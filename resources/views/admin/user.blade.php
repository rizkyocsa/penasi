@extends('adminlte::page')

@section('title', 'Siswa Page')

@section('content_header')
    <h1>Data Siswa</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
                <div class="card-header">{{ __('Pengelolaan Siswa')}}</div>
            <div class="card-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal"><i class="fa fa-plus"></i>Tambah Data</button>                
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#importDataModal">Import</button>
                <hr>
                <table id="table-data" class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <!-- <th>NIK</th> -->
                            <th>NAMA</th>
                            <th>EMAIL</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-user" class="btn btn-success" data-toggle="modal" data-target="#editUserModal" data-id="{{ $data->id }}">Edit</button>
                                        <button class="btn btn-danger" onclick="deleteConfirmation('{{$data->id}}','{{$data->name}}')">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah User -->
    <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Tambah Data Siswa
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user.submit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="deskripsi">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">NISN</label>
                            <input type="text" name="username" id="username" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required/>
                        </div>
                        <!-- <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control" required/>
                        </div> -->
                        <div class="row">
                            <button type="submit" class="btn btn-primary w-100">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Edit Data Penasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                            <div class="form-group">
                                <label for="deskripsi">Nama</label>
                                <input type="text" name="name" id="edit-name" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Nik</label>
                                <input type="text" name="username" id="edit-username" class="form-control" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Email</label>
                                <input type="email" name="email" id="edit-email" class="form-control" required/>
                            </div>
                            <!-- <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <input type="text" name="deskripsi" id="deskripsi" class="form-control" required/>
                            </div> -->                      
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="edit-id" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import Data User -->
    <div class="modal fade" id="importDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Import Data
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="cover">Upload File</label>
                            <input type="file" name="file" class="form-control"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Import Data</button>
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
        $(document).on('click','#btn-edit-user', function(){
            let id = $(this).data('id');
            // alert(id);
            $.ajax({
                type: "get",
                url: "{{url('admin/ajaxadmin/dataUser')}}/"+id,
                dataType: 'json',
                success: function(res){
                    // console.log(res);
                    $('#edit-id').val(res.id);
                    $('#edit-name').val(res.name);
                    $('#edit-username').val(res.username);
                    $('#edit-email').val(res.email);
                },
            });
        });
    });

    //Delete
    function deleteConfirmation(id, name){
        Swal.fire({
            title: "Hapus?",
            icon: 'warning',
            text: "Apakah anda yakin akan menghapus data user dengan nama " + name +" ?!",
            showCancelButton: !0,
            confirmButtonText: "Ya, Lakukan!",
            cancelButtonText: "Tidak, batalkan!", 
            reverseButtons: !0
        }).then(function (e){
            if(e.value === true){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'DELETE',
                    url: "user/delete/" + id,
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