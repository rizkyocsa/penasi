<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <title>Document</title> -->
</head>
<body>
    <h1 class="text-center">DATA PENASI</h1>
    <p class="text-center">LAPORAN DATA PENASI</p>
    <br>
    <table id="table-data" class="table table-bordered table responsive">
        <thead>
            <tr>
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
            @php $no=1; @endphp
            @foreach($penasis as $penasi)
                <tr>
                    <!-- <td>{{$loop->iteration}}</td> -->
                    <td>{{$no++}}</td>
                    <td>{{$penasi->jenis}}</td>
                    <td>{{$penasi->deskripsi}}</td>
                    <td>{{$penasi->kategori}}</td>
                    <td>
                        @if($penasi->berkasPendukung !== null)
                        <img src="{{ public_path('storage/berkasPendukung/'.$penasi->berkasPendukung) }}" width="100px" class="mx-auto d-block"/>
                        <!-- [Gambar tersedia] -->
                        @else
                            [Gambar tidak tersedia]
                        @endif
                    </td>
                    <td>{{$penasi->tanggapan}}</td>
                    <td>{{$penasi->status}}</td>
                    <td>{{$penasi->pengirim}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>