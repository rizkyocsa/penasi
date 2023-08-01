@extends('adminlte::page')

@section('title', 'Ganti Password')

@section('content_header')
    <h1>Ganti Password</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
                <div class="card-header">{{ __('Ganti Password')}}</div>
            <div class="card-body">
                <form action="{{ route('change.password')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="deskripsi">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Konfrimasi Password Baru</label>
                            <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control" required/>
                        </div>
                    <div class="row">
                        <input type="hidden" value="{{$user->username}}"  name="username" id="username" class="form-control" required/>
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