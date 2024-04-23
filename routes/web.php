<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//buku
Route::get('/home{kategori?}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/buku-detail{id}', [App\Http\Controllers\HomeController::class, 'detailBuku'])->name('buku-detail');
Route::get('/buku-pdf{id}', [App\Http\Controllers\HomeController::class, 'pdfBuku'])->name('buku-pdf');
Route::get('/komentar-store', [App\Http\Controllers\HomeController::class, 'komentar'])->name('komentar-store');
//member
Route::get('/member', [App\Http\Controllers\MemberController::class, 'index'])->name('member');
Route::post('/member-store', [App\Http\Controllers\MemberController::class, 'store'])->name('member-store');
//bookmark
Route::get('/bookmark-store{id}', [App\Http\Controllers\HomeController::class, 'bookmark'])->name('bookmark-store');
Route::get('/bookmark-destroy{id}', [App\Http\Controllers\BookmarkController::class, 'destroy'])->name('bookmark-destroy');
Route::get('/bookmark', [App\Http\Controllers\BookmarkController::class, 'index'])->name('bookmark');


//Petugas
Route::middleware(['auth','petugas'])->group(function () {
Route::get('/dashboard-petugas', [App\Http\Controllers\Dashboard\Petugas\DashboardController::class, 'index'])->name('dashboard-petugas');
Route::get('/databuku-petugas', [App\Http\Controllers\Dashboard\Petugas\DataBukuController::class, 'index'])->name('databuku-petugas');
Route::post('databuku-petugas-store', [App\Http\Controllers\Dashboard\Petugas\DataBukuController::class, 'store'])->name('databuku-petugas-store');
Route::get('databuku-petugas-datatable', [App\Http\Controllers\Dashboard\Petugas\DataBukuController::class, 'datatable'])->name('databuku-petugas-datatable');
Route::get('databuku-petugas-edit/{id}', [App\Http\Controllers\Dashboard\Petugas\DataBukuController::class, 'edit'])->name('databuku-petugas-edit');
Route::post('databuku-petugas-update', [App\Http\Controllers\Dashboard\Petugas\DataBukuController::class, 'update'])->name('databuku-petugas-update');
Route::get('databuku-petugas-destroy/{id}', [App\Http\Controllers\Dashboard\Petugas\DataBukuController::class, 'destroy'])->name('databuku-petugas-destroy');
Route::get('databuku-petugas-print', [App\Http\Controllers\Dashboard\Petugas\DataBukuController::class, 'print'])->name('databuku-petugas-print');
});


