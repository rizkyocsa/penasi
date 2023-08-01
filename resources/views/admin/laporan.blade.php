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
                            <th>TGL</th>
                            <th>JENIS</th>
                            <th>DESKRIPSI</th>
                            <th>KATEGORI</th>
                            <th>BERKAS PENDUKUNG</th>
                            <th>TEMPAT</th>
                            <th>TANGGAPAN</th>
                            <th>STATUS</th>
                            <th>PENGIRIM</th>
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
                                @if($data->status == "Selesai")
                                    <span class="badge bg-success">{{$data->status}}</span>
                                @elseif($data->status == "Ditolak")
                                    <span class="badge bg-danger">{{$data->status}}</span>
                                @else
                                    <span class="badge bg-warning">{{$data->status}}</span>  
                                @endif  
                                </td>
                                <td>
                                @if($data->anonim == true)
                                    <p>anonim</p>
                                @else
                                    {{$data->pengirim}}
                                @endif    
                                </td>
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