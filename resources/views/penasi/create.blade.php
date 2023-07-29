@extends('adminlte::page')

@section('title', 'Pengaduan dan Aspirasi Page')

@section('content_header')
    <h1>Pengaduan dan Aspirasi Siswa</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
                <div class="card-header">{{ __('Buat Pengaduan dan Aspirasi')}}</div>
            <div class="card-body">
                <form action="{{ route('penasi.submit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="jenis">Silahkan Pilih Jenis</label>
                            <select class="custom-select jenis" id="jenis" name="jenis">
                                <option value="">--Jenis--</option>
                                <option value="Pengaduan">Pengaduan</option>
                                <option value="Aspirasi">Aspirasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Silahkan Pilih Kategori</label>
                            <select class="custom-select" id="kategori" name="kategori">
                                <option value="">--Kategori--</option>
                                <!-- <option value="Pengaduan">Pengaduan</option>
                                <option value="Aspirasi">Aspirasi</option> -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Berkas Pendukung</label>
                            <input type="file" class="form-control rounded" id="berkasPendukung" name="berkasPendukung" placeholder="Berkas Pendukung">
                        </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@yield('adminlte_js')

@section('js')
<script>
        $('.jenis').change(function() {
            var id = $(this).val();
            // alert(id); 
            var kategori= document.getElementById('kategori');
            if(id == "Pengaduan")
            {
                $(kategori).empty();
                $(kategori).append('<option value="Psikologi" > Psikologi </option>');
                $(kategori).append('<option value="Kekerasan" > Kekerasan </option>');
                $(kategori).append('<option value="Kegiatan Belajar Mengajar (KBM)" > Kegiatan Belajar Mengajar (KBM) </option>');
                $(kategori).append('<option value="Sarana dan Prasana" > Saran dan Prasana </option>');
            }else if(id == "Aspirasi"){
                $(kategori).empty();
                $(kategori).append('<option value="Kegiatan Belajar Mengajar (KBM)" > Kegiatan Belajar Mengajar (KBM) </option>');
                $(kategori).append('<option value="Sarana dan Prasana" > Saran dan Prasana </option>');
            }else{
                $(kategori).empty();
                $(kategori).append('<option value="" > --Kategori-- </option>');
            }
        });


        // $(function(){
        //     $(document).on('change','#kategori', function(){
        //         let id = $(this).val();
        //         alert(id);
        //         $('#image-area').empty();
        //         $.ajax({
        //             type: "get",
        //             url: "{{url('/admin/ajaxadmin/dataBuku')}}/"+id,
        //             dataType: 'json',
        //             success: function(res){
        //                 $('#edit-judul').val(res.judul);
        //                 $('#edit-penerbit').val(res.penerbit);
        //                 $('#edit-penulis').val(res.penulis);
        //                 $('#edit-tahun').val(res.tahun);
        //                 $('#edit-id').val(res.id);
        //                 $('#edit-old-cover').val(res.cover);
        //                 if(res.cover !== null){
        //                     $('#image-area').append(
        //                         "<img src='"+baseurl+"/storage/cover_buku/"+res.cover+"' width='200px'>"
        //                     );
        //                 }else{
        //                     $('#image-area').append('[Gambar tidak tersedia]');
        //                 }
        //             },
        //         });
        //     });
        // });
</script>
@endsection