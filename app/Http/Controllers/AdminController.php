<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BooksExport;
use App\Imports\BooksImport;
use App\Models\Book;
use App\Models\Penasi;
use App\Models\User;
use PDF;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $users = User::All()->count();
        $proses = Penasi::All()->where('status', '3')->count();
        $selesai = Penasi::All()->where('status', '1')->count();
        $ditolak = Penasi::All()->where('status', '2')->count();

        $pengaduan = [];
        $aspirasi = [];

        for ($month = 1; $month <= 12; $month++) {
            $count = Penasi::whereMonth('created_at', $month)
                               ->where('jenis', 'Pengaduan')
                               ->count();
            $pengaduan[] = $count;
        }

        for ($month = 1; $month <= 12; $month++) {
            $count = Penasi::whereMonth('created_at', $month)
                               ->where('jenis', 'Aspirasi')
                               ->count();
            $aspirasi[] = $count;
        }
        // dd($pengaduan);
        return view('home', compact('user', 'users', 'proses','selesai','ditolak','pengaduan','aspirasi'));
    }
    
}
