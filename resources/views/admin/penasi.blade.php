@extends('adminlte::page')

@section('title', 'Penasi Page')

@section('content_header')
    <h1>Data Penasi</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
                <div class="card-header">{{ __('Pengelolaan Penasi')}}</div>
            <div class="card-body">
                <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal"><i class="fa fa-plus"></i>Tambah Data</button>                 -->
                <!-- <hr> -->
                <table id="table-data" class="table table-bordered table-responsive">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>TGL</th>
                            <th>JENIS</th>
                            <th>DESKRIPSI</th>
                            <th>KATEGORI</th>
                            <th>BERKAS PENDUKUNG</th>
                            <th>TEMPAT</th>
                            <th>TANGGAPAN</th>
                            <th>BERKAS PENYELESAIAN</th>
                            <th>STATUS</th>
                            <th>PENGIRIM</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penasi as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->created_at->day}} - {{$data->created_at->month}} - {{$data->created_at->year}}</td>
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
                                @if($data->anonim == 1)
                                    <p>anonim</p>
                                @else
                                    {{$data->pengirim}}
                                @endif  
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-tanggapi" class="btn btn-success" data-toggle="modal" data-target="#tanggapiModal" data-id="{{ $data->id }}"
                                        {{ $data->status == 3 ? '' : 'disabled' }}>
                                        Tanggapi
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

    <!-- Modal Edit Penasi -->
    <div class="modal fade" id="tanggapiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Tanggapi Data Penasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.penasi.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis">Silahkan Pilih Jenis</label>
                                    <select class="custom-select jenis" id="edit-jenis" name="edit-jenis" disabled>
                                        <option value="">--Jenis--</option>
                                        <option value="Pengaduan">Pengaduan</option>
                                        <option value="Aspirasi">Aspirasi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <input type="text" name="edit-deskripsi" id="edit-deskripsi" class="form-control" required disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Silahkan Pilih Kategori</label>
                                    <select class="custom-select" id="edit-kategori" name="kategori" disabled>
                                        <option value="">--Kategori--</option>
                                        <option value="Psikologi" > Psikologi </option>
                                        <option value="Kekerasan" > Kekerasan </option>
                                        <option value="Kegiatan Belajar Mengajar (KBM)" > Kegiatan Belajar Mengajar (KBM) </option>
                                        <option value="Saran dan Prasana" > Sarana dan Prasana </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label for="jenis">Silahkan Pilih Tanggapan</label>
                                    <select class="custom-select" name="status" id="edit-status">
                                        <option value="3" hidden>--Tanggapan--</option>
                                        <option value="1">Diterima</option>
                                        <option value="2">Ditolak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Tanggapan</label>
                                    <textarea cols="30" rows="10"
                                    type="text" name="tanggapan" id="edit-tanggapan" class="form-control" required/></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Berkas Penyelesaian (Optional)</label>
                                    <input type="file" class="form-control rounded" id="berkasPenyelesaian" name="berkasPenyelesaian" placeholder="Berkas Penyelesaian">
                                </div>
                                <!-- <div class="form-group" id="image-area"></div>
                                <div class="form-group">
                                    <label for="edit-berkasPendukung">Cover</label>
                                    <input type="file" name="cover" id="edit-berkasPendukung" class="form-control" required/>
                                    {!!$errors->first('berkasPendukung', '<span class="text-danger">:message</span>')!!}
                                </div> -->
                            </div>
                        </div>                        
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="edit-id">
                            <input type="hidden" name="old-berkasPendukung" id="old-berkasPendukung">
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
        alert(id); 
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
                            // $(kategori).append('<option value="{{$data->kategori}}" > {{$data->kategori}} </option>');

                            var option = $('<option>', {
                                value: item.kategori, // Replace 'value' with the appropriate property from your data
                                text: item.kategori // Replace 'text' with the appropriate property from your data
                            });

                            select.append(option);
                        });
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
                            // $(kategori).append('<option value="{{$data->kategori}}" > {{$data->kategori}} </option>');

                            var option = $('<option>', {
                                value: item.kategori, // Replace 'value' with the appropriate property from your data
                                text: item.kategori // Replace 'text' with the appropriate property from your data
                            });

                            select.append(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
        }else{
            $(kategori).empty();
            $(kategori).append('<option value="" > --Kategori-- </option>');
        }
    });

    //Modal Edit
    $(function(){
        $(document).on('click','#btn-tanggapi', function(){
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
                    $('#edit-status option[value="'+res.status+'"]').attr("selected", "selected");
                    // $('#edit-kategori').val(res.kategori);
                    $('#edit-id').val(res.id);
                    $('#old-berkasPendukung').val(res.berkasPendukung);
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
</script>
@endsection