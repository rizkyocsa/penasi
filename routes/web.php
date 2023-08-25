<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])
    ->name('home')
    ->middleware('auth');

//Route::get('/home', function(){
//    return view('home');
//})->middleware('auth');

//Route::get('/hello', function(){
//    return "hello";
//})->middleware('auth');

Route::get('admin/home', [App\Http\Controllers\AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('is_admin');

//View Buku User
Route::get('books', [App\Http\Controllers\AdminController::class, 'books']);

//Master BUKU
Route::get('admin/books', [App\Http\Controllers\AdminController::class, 'books'])
    ->name('admin.books')
    ->middleware('is_admin');

Route::post('admin/books', [App\Http\Controllers\AdminController::class, 'submit_book'])
    ->name('admin.book.submit')
    ->middleware('is_admin');
    
Route::patch('admin/books/update', [App\Http\Controllers\AdminController::class, 'update_book'])
    ->name('admin.book.update')
    ->middleware('is_admin');

Route::get('admin/ajaxadmin/dataBuku/{id}', [App\Http\Controllers\AdminController::class, 'getDataBuku']);

Route::post('admin/books/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_book'])
    ->name('admin.book.delete')
    ->middleware('is_admin');

//PDF
Route::get('admin/print_books', [App\Http\Controllers\AdminController::class, 'print_books'])
    ->name('admin.print.books')
    ->middleware('is_admin');

//Excel
Route::get('admin/books/export', [App\Http\Controllers\AdminController::class, 'export'])
    ->name('admin.book.export')
    ->middleware('is_admin');

Route::post('admin/books/import', [App\Http\Controllers\AdminController::class, 'import'])
    ->name('admin.book.import')
    ->middleware('is_admin');

//Master Penasi (User)
Route::get('penasi', [App\Http\Controllers\PenasiController::class, 'penasi'])
    ->name('penasi');

Route::post('penasi', [App\Http\Controllers\PenasiController::class, 'submit_penasi'])
    ->name('penasi.submit');

Route::get('penasi/check', [App\Http\Controllers\PenasiController::class, 'check_penasi'])
    ->name('check.penasi');

Route::patch('penasi/update', [App\Http\Controllers\PenasiController::class, 'update_penasi'])
    ->name('penasi.update');

Route::get('penasi/delete/{id}', [App\Http\Controllers\PenasiController::class, 'delete_penasi'])
    ->name('penasi.delete');

Route::get('ajaxadmin/dataPenasi/{id}', [App\Http\Controllers\PenasiController::class, 'getDataPenasi']);

Route::get('getKategori/{jenis}', [App\Http\Controllers\PenasiController::class, 'getKategori']);

Route::get('change', [App\Http\Controllers\UsersController::class, 'change'])
    ->name('change');

Route::post('change/password', [App\Http\Controllers\UsersController::class, 'change_password'])
    ->name('change.password');

//Master User
Route::get('admin/user', [App\Http\Controllers\UsersController::class, 'user'])
    ->name('admin.user')
    ->middleware('is_admin');

Route::post('admin/user', [App\Http\Controllers\UsersController::class, 'submit_user'])
    ->name('admin.user.submit')
    ->middleware('is_admin');

Route::get('admin/ajaxadmin/dataUser/{id}', [App\Http\Controllers\UsersController::class, 'getDataUser'])
    ->middleware('is_admin');

Route::patch('admin/user/update', [App\Http\Controllers\UsersController::class, 'update_user'])
    ->name('admin.user.update')
    ->middleware('is_admin');

Route::delete('admin/user/delete/{id}', [App\Http\Controllers\UsersController::class, 'delete_user'])
    ->name('admin.user.delete')
    ->middleware('is_admin');

Route::post('admin/user/import', [App\Http\Controllers\UsersController::class, 'import'])
    ->name('admin.user.import')
    ->middleware('is_admin');

//Master Admin Kategori
Route::get('admin/kategori', [App\Http\Controllers\KategoriController::class, 'index'])
    ->name('admin.kategori')
    ->middleware('is_admin');

Route::post('admin/kategori', [App\Http\Controllers\KategoriController::class, 'submit_kategori'])
    ->name('admin.kategori.submit')
    ->middleware('is_admin');

Route::get('admin/ajaxadmin/dataKategori/{id}', [App\Http\Controllers\KategoriController::class, 'getDataKategori'])
    ->middleware('is_admin');

Route::patch('admin/kategori/update', [App\Http\Controllers\KategoriController::class, 'update_kategori'])
    ->name('admin.kategori.update')
    ->middleware('is_admin');

Route::delete('admin/kategori/delete/{id}', [App\Http\Controllers\KategoriController::class, 'delete_kategori'])
    ->name('admin.kategori.delete')
    ->middleware('is_admin');

//Master Admin Penasi
Route::get('admin/penasi', [App\Http\Controllers\PenasiController::class, 'index'])
    ->name('admin.penasi')
    ->middleware('is_admin');

Route::get('admin/ajaxadmin/dataPenasi/{id}', [App\Http\Controllers\PenasiController::class, 'getDataPenasi'])
    ->middleware('is_admin');

Route::patch('admin.penasi/update', [App\Http\Controllers\PenasiController::class, 'tanggapi_penasi'])
    ->name('admin.penasi.update')
    ->middleware('is_admin');

//Laporan
Route::get('admin/laporan', [App\Http\Controllers\PenasiController::class, 'laporan'])
    ->name('admin.laporan')
    ->middleware('is_admin');
    
Route::get('admin/laporan/print', [App\Http\Controllers\PenasiController::class, 'laporan_print'])
    ->name('admin.laporan.print')
    ->middleware('is_admin');