@extends('adminlte::page')

@section('title', 'Pengaduan dan Aspirasi')

@section('content_header')
    <h1>Check Pengaduan dan Aspirasi</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default"> 
                <div class="card-header">{{ __('Check Pengaduan dan Aspirasi')}}</div>
            <div class="card-body">
                <table id="table-data" class="table table-bordered table-responsive">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>JENIS</th>
                            <th>DESKRIPSI</th>
                            <th>KATEGORI</th>
                            <th>BERKAS</th>
                            <th>TEMPAT</th>
                            <th>TANGGAPAN</th>
                            <th>BERKAS</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach($penasi as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->jenis}}</td>
                                <td>{{$data->deskripsi}}</td>
                                <td>{{$data->kategori}}</td>
                                <td>
                                    @if($data->berkasPendukung !== null)
                                    <img src="{{ asset('storage/berkasPendukung/'.$data->berkasPendukung) }}" width="100px" class="mx-auto d-block"/>
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif
                                </td>
                                <td>{{$data->tempat}}</td>
                                <td>{{$data->tanggapan}}</td>
                                <td>
                                    @if($data->berkasPenyelesaian !== null)
                                    <img src="{{ asset('storage/berkasPenyelesaian/'.$data->berkasPenyelesaian) }}" width="100px" class="mx-auto d-block"/>
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif
                                </td>
                                <td>
                                @if($data->status == 1)
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($data->status == 2)
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>  
                                @endif  
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-penasi" class="btn btn-success" data-toggle="modal" data-target="#editPenasi" data-id="{{ $data->id }}" 
                                        {{ $data->status == 3 ? '' : 'disabled' }}>
                                            Edit
                                        </button>
                                        <button class="btn btn-danger" onclick="deleteConfirmation('{{$data->id}}','{{$data->deskripsi}}')"
                                        {{ $data->status == 3 ? '' : 'disabled' }}>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Buku -->
    <div class="modal fade" id="editPenasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form action="{{ route('penasi.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis">Silahkan Pilih Jenis</label>
                                    <select class="custom-select editjns" name="jenis" id="edit-jenis" >
                                        <option value="">--Jenis--</option>
                                        <option value="Pengaduan">Pengaduan</option>
                                        <option value="Aspirasi">Aspirasi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <input type="text" name="deskripsi" id="edit-deskripsi" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Silahkan Pilih Kategori</label>
                                    <select class="custom-select" name="kategori" id="edit-kategori" >
                                        <option value="">--Kategori--</option>
                                        <!-- <option value="Psikologi" > Psikologi </option>
                                        <option value="Kekerasan" > Kekerasan </option>
                                        <option value="Kegiatan Belajar Mengajar (KBM)" > Kegiatan Belajar Mengajar (KBM) </option>
                                        <option value="Saran dan Prasana" > Saran dan Prasana </option> -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tempat">Tempat</label>
                                    <input type="text" name="tempat" id="edit-tempat" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="image-area"></div>
                                <div class="form-group">
                                    <label for="edit-berkasPendukung">Berkas Pendukung</label>
                                    <input type="file" name="berkasPendukung" id="edit-berkasPendukung" class="form-control"/>
                                    {!!$errors->first('berkasPendukung', '<span class="text-danger">:message</span>')!!}
                                </div>
                            </div>
                        </div>                        
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="edit-id">
                            <input type="text" name="old-berkasPendukung" id="old-berkasPendukung">
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
        $('.jenis').change(function() {
            var jenis = $(this).val();
            // alert(id); 
            var kategori= document.getElementById('kategori');
            if(jenis == "Pengaduan")
            {
                $(kategori).empty();
                $.ajax({
                    url: '/getKategori/' + jenis,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var select = $('#kategori');

                        $.each(data, function(index, item) {
                            

                            var option = $('<option>', {
                                value: item.kategori, // Replace 'value' with the appropriate property from your data
                                text: item.kategori // Replace 'text' with the appropriate property from your data
                            });

                            select.append(option);
                            
                        });
                        $(kategori).append('<option value="Lainnya" >Lainnya</option>');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
                // $(kategori).append('<option value="Psikologi" > Psikologi </option>');
                // $(kategori).append('<option value="Kekerasan" > Kekerasan </option>');
                // $(kategori).append('<option value="Kegiatan Belajar Mengajar (KBM)" > Kegiatan Belajar Mengajar (KBM) </option>');
                // $(kategori).append('<option value="Sarana dan Prasana" > Sarana dan Prasana </option>');
                
            }else if(jenis == "Aspirasi"){
                $(kategori).empty();
                
                $.ajax({
                    url: 'getKategori/' + jenis,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var select = $('#kategori');

                        $.each(data, function(index, item) {


                            var option = $('<option>', {
                                value: item.kategori, // Replace 'value' with the appropriate property from your data
                                text: item.kategori // Replace 'text' with the appropriate property from your data
                            });

                            select.append(option);
                            
                        });
                        $(kategori).append('<option value="Lainnya" >Lainnya</option>');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
                // $(kategori).append('<option value="Kegiatan Belajar Mengajar (KBM)" > Kegiatan Belajar Mengajar (KBM) </option>');
                // $(kategori).append('<option value="Sarana dan Prasana" > Sarana dan Prasana </option>');
                
            }else{
                $(kategori).empty();
                $(kategori).append('<option value="" > --Kategori-- </option>');
            }
        });

        $('.editjns').change(function() {
            var jenis = $(this).val();
            // alert(id); 
            var kategori= document.getElementById('edit-kategori');
            if(jenis == "Pengaduan")
            {
                $(kategori).empty();
                $.ajax({
                    url: '/getKategori/' + jenis,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var select = $('#edit-kategori');

                        $.each(data, function(index, item) {
                            

                            var option = $('<option>', {
                                value: item.kategori, // Replace 'value' with the appropriate property from your data
                                text: item.kategori // Replace 'text' with the appropriate property from your data
                            });

                            select.append(option);
                            
                        });
                        $(kategori).append('<option value="Lainnya" >Lainnya</option>');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
                
            }else if(jenis == "Aspirasi"){
                $(kategori).empty();
                
                $.ajax({
                    url: '/getKategori/' + jenis,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var select = $('#edit-kategori');

                        $.each(data, function(index, item) {
                            

                            var option = $('<option>', {
                                value: item.kategori, // Replace 'value' with the appropriate property from your data
                                text: item.kategori // Replace 'text' with the appropriate property from your data
                            });

                            select.append(option);
                            
                        });
                        $(kategori).append('<option value="Lainnya" >Lainnya</option>');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
                
            }else{
                $(kategori).empty();
                // $(kategori).append('<option value="" > --Kategori-- </option>');
            }
        });

        //Modal Edit
        $(function(){
            $(document).on('click','#btn-edit-penasi', function(){
                let id = $(this).data('id');
                // alert(id);
                $('#image-area').empty();
                $.ajax({
                    type: "get",
                    url: "{{url('ajaxadmin/dataPenasi')}}/"+id,
                    dataType: 'json',
                    success: function(res){
                        console.log(res);
                        console.log(res.jenis);
                        // $('#edit-name').val(res.name);
                        $('#edit-jenis option[value="'+res.jenis+'"]').attr("selected", "selected");
                        $('#edit-deskripsi').val(res.deskripsi);
                        $('#edit-kategori option[value="'+res.kategori+'"]').attr("selected", "selected");
                        // $('#edit-kategori').val(res.kategori);
                        $('#edit-id').val(res.id);
                        $('#old-berkasPendukung').val(res.berkasPendukung);
                        $('#edit-tempat').val(res.tempat);
                        if(res.cover !== null){
                            $('#image-area').append(
                                "<img src='"+baseurl+"/storage/berkasPendukung/"+res.berkasPendukung+"' width='200px'>"
                            );
                        }else{
                            $('#image-area').append('[Gambar tidak tersedia]');
                        }
                    },
                });
            });
        });

    //Delete
    function deleteConfirmation(id, jenis){
        Swal.fire({
            title: "Hapus?",
            icon: 'warning',
            text: "Apakah anda yakin akan menghapus data penasi dengan jenis " + jenis +" ?!",
            showCancelButton: !0,
            confirmButtonText: "Ya, Lakukan!",
            cancelButtonText: "Tidak, batalkan!", 
            reverseButtons: !0
        }).then(function (e){
            if(e.value === true){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "get",
                    url: "delete/" + id,
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