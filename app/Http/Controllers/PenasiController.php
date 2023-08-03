<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

use App\Models\Penasi;
use PDF;

class PenasiController extends Controller
{
    public function penasi()
    {
        return view('penasi.create');
    }

    public function index(){
        $user = Auth::user();
        $penasi = Penasi::all();
        return view('admin.penasi' , compact('user', 'penasi'));
    }

    public function laporan(){
        $user = Auth::user();
        $penasi = Penasi::all();
        return view('admin.laporan' , compact('user', 'penasi'));
    }

    public function check_penasi()
    {
        $user = Auth::user()->name;
        $penasi = Penasi::all()->where('pengirim', $user);
        return view('penasi.check' , compact('user', 'penasi'));
    }

    public function submit_penasi(Request $req)
    {   

        $validate = $req->validate([
            'jenis' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            // 'berkasPendukung' => 'required',
        ]);

        $user = Auth::user()->name;

        $penasi = new Penasi;

        $penasi->kategori = $req->get('kategori');
        $penasi->deskripsi = $req->get('deskripsi');
        $penasi->jenis = $req->get('jenis');
        $penasi->berkasPendukung = $req->get('berkasPendukung');
        $penasi->tempat = $req->get('tempat');
        $penasi->status = "Proses";
        $penasi->pengirim = $user;

        // dd($req->get('berkasPendukung'));

        if($req->get('checkbox') == null || $req->get('checkbox') == "false"){
            $penasi->anonim = "false";   
        }else{
            $penasi->anonim = $req->get('checkbox');   
        }

        if ($req->hasFile('berkasPendukung')) {
            $extension = $req->file('berkasPendukung')->extension();
            $filename = 'berkasPendukung'.time().'.'.$extension;
            $req->file('berkasPendukung')->storeAs(
                'public/berkasPendukung', $filename
            );
            $penasi->berkasPendukung = $filename ;
        }

        $penasi->save();

        $notification = array(
            'message' =>'Pengaduan/Aspirasi berhasil dikirim', 
            'alert-type' =>'success'
        );

        return redirect()->route('penasi')->with($notification);
    }

    public function getDataPenasi($id)
    {
        $penasi = Penasi::find($id);

        return response()->json($penasi);
    }

    public function update_penasi(Request $req){
        $penasi = Penasi::find($req->get('id'));

        // dd($penasi);

        $validate = $req->validate([
            'jenis' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            // 'berkasPendukung' => 'required',
        ]);

        $penasi->jenis = $req->get('jenis');
        $penasi->deskripsi = $req->get('deskripsi');
        $penasi->kategori = $req->get('kategori');
        // $penasi->berkasPendukung = $req->get('berkasPendukung');
        $penasi->tempat = $req->get('tempat');

        // $cek = $req->get('tempat');
        // dd($cek);

        // if($req->get('berkasPendukung') !== null){
            
            if($req->hasFile('berkasPendukung')){
                $extension = $req->file('berkasPendukung')->extension();
    
                $filename = 'berkasPendukung'.time().'.'.$extension;
    
                $req->file('berkasPendukung')->storeAs(
                    'public/berkasPendukung', $filename
                );
    
                Storage::delete('public/berkasPendukung/'.$req->get('old-berkasPendukung'));
                $penasi->berkasPendukung = $filename;
            }else{
                $penasi->berkasPendukung = $req->get('old-berkasPendukung');
            }
        // }else{
        //     $penasi->berkasPendukung = $req->get('old-berkasPendukung');
        // }

        $penasi->save();

        $notification = array(
            'message' => 'Pengaduan/Aspirasi berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('check.penasi')->with($notification);
    }

    public function tanggapi_penasi(Request $req){
        $penasi = Penasi::find($req->get('id'));

        $validate = $req->validate([
            'tanggapan' => 'required',
            'status' => 'required',
        ]);
        

        $penasi->tanggapan = $req->get('tanggapan');
        $penasi->status = $req->get('status');

        if($penasi->status == "Proses"){
            $notification = array(
                'message' => 'Tolong pilih status tanggapi',
                'alert-type' => 'warning'
            );
    
            return redirect()->route('admin.penasi')->with($notification);
        }

        $penasi->save();

        $notification = array(
            'message' => 'Pengaduan/Aspirasi berhasil ditanggapi',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.penasi')->with($notification);
    }

    public function delete_penasi($id){
        $penasi = Penasi::find($id);        

        $penasi->delete();

        $success = true;
        $message = "Data penasi berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function laporan_print(){
        $penasis = Penasi::all();
        set_time_limit(300);
        // dd($penasi);
        $pdf = PDF::loadview('print_laporan',['penasis'=>$penasis]);
        return $pdf->download('data_penasi.pdf');
    }

    public  function print_books(){
        $books = Book::all();
        dd($books);
        $pdf = PDF::loadview('print_books',['books'=>$books]);
        return $pdf->download('data_buku.pdf');
    }
}
