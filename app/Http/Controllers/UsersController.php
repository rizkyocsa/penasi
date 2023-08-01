<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Imports\UsersImport;

class UsersController extends Controller
{
    public function user()
    {
        $user = User::All()->where('roles_id', 2);
        return view('admin.user', compact('user'));
    }

    public function submit_user(Request $req)
    {   

        $validate = $req->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);

        $user = new User;

        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        $user->password = Hash::make('12345678');
        $user->tahun_ajaran = date("Y");
        $user->roles_id = 2;

        $user->save();

        $notification = array(
            'message' =>'Tambah Data Siswa berhasil', 
            'alert-type' =>'success'
        );

        return redirect()->route('admin.user')->with($notification);
    }

    public function getDataUser($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function update_user(Request $req){
        $id = $req->get('id');

        $user = User::All()->where('id', $id)->first();

        $validate = $req->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        

        if($req->get('tahun_ajaran') == ""){
            $user->name = $req->get('name');
            $user->email = $req->get('email');
        }else{
            $user->name = $req->get('name');
            $user->email = $req->get('email');
            $user->tahun_ajaran = $req->get('tahun_ajaran');
        }

        $user->save();

        $notification = array(
            'message' =>'Update Data Siswa berhasil', 
            'alert-type' =>'success'
        );

        return redirect()->route('admin.user')->with($notification);
    }

    public function delete_user($id){
        $user = User::find($id);        

        $user->delete();

        $success = true;
        $message = "Data user berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function change(Request $req){
        $user = Auth::user();
        return view('change', compact('user'));
    }

    public function change_password(Request $req){
        $id = $req->get('username');
        
        $user = User::All()->where('username', $id)->first();

        $validate = $req->validate([
            'password' => 'required',
            'konfirmasi_password' => 'required',
        ]);

        if($req->get('password') == $req->get('konfirmasi_password')){
            $user->password = Hash::make($req->get('password'));

            $user->save();

            $notification = array(
                'message' =>'Ganti Password berhasil', 
                'alert-type' =>'success'
            );

            return redirect()->route('change')->with($notification);
        }else{
            $notification = array(
                'message' =>'Ganti Password Gagal, coba cek kembali passwordnya', 
                'alert-type' =>'warning'
            );

            return redirect()->route('change')->with($notification);
        }
        
    }

    public function import(Request $req){
        Excel::import(new UsersImport, $req->file('file'));

        $notification = array(
            'message' => 'Import data berhasil',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.user')->with($notification);
    }

    // public function import(Request $req){
    //     Excel::import(new BooksImport, $req->file('file'));

    //     $notification = array(
    //         'message' => 'Import data berhasil',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('admin.books')->with($notification);
    // }
}
