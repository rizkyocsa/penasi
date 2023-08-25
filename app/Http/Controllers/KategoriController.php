<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(){
        $user = Auth::user();
        $kategori = Kategori::all();
        
        return view('admin.kategori' , compact('user', 'kategori'));
    }

    public function submit_kategori(Request $req){

        $validate = $req->validate([
            'jenis' => 'required',
            'kategori' => 'required',
        ]);


        $kategori = new Kategori;

        $kategori->jenis = $req->get('jenis');
        $kategori->kategori = $req->get('kategori');

        $kategori->save();

        $notification = array(
            'message' =>'Kategori berhasil ditambahkan', 
            'alert-type' =>'success'
        );

        return redirect()->route('admin.kategori')->with($notification);
    }

    public function update_kategori(Request $req){
        $kategori = Kategori::find($req->get('id'));
        
        $validate = $req->validate([
            'jenis' => 'required',
            'kategori' => 'required',
        ]);

        $kategori->jenis = $req->get('jenis');
        $kategori->kategori = $req->get('kategori');

        $kategori->save();

        $notification = array(
            'message' =>'Kategori berhasil diupdate', 
            'alert-type' =>'success'
        );

        return redirect()->route('admin.kategori')->with($notification);
    }

    public function delete_kategori(){
        $kategori = Kategori::find($id);        

        $kategori->delete();

        $success = true;
        $message = "Data kategori berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function getDataKategori($id){
        $kategori = Kategori::find($id);

        return response()->json($kategori);
    }
}
