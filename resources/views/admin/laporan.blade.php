@extends('adminlte::page')

@section('title', 'Laporan Page')

@section('content_header')
    <h1>Laporan</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
                <div class="card-header">{{ __('Laporan')}}</div>
            <div class="card-body">
                <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal"><i class="fa fa-plus"></i>Tambah Data</button>                 -->
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('admin.laporan.print')}}" class="btn btn-secondary" target="_blank"><i class="fa fa-print"></i>Cetak PDF Penasi</a>    
                    </div>
                <hr>
                <table id="table-data" class="table table-bordered table-responsive">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>JENIS</th>
                            <th>DESKRIPSI</th>
                            <th>KATEGORI</th>
                            <th>BERKAS PENDUKUNG</th>
                            <th>TANGGAPAN</th>
                            <th>STATUS</th>
                            <th>PENGIRIM</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penasi as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
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
                                <td>{{$data->tanggapan}}</td>
                                <td>{{$data->status}}</td>
                                <td>{{$data->pengirim}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
@endsection


@yield('adminlte_js')

@section('js')
<script>
    
</script>
@endsection