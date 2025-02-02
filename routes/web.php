<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransaksiController;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AnggotaImport;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('buku/{id_buku}/reservasi', [TransaksiController::class, 'create'])->name('buku.reservasi');
    Route::post('buku/reservasi', [TransaksiController::class, 'storeReservasi'])->name('buku.storeReservasi');
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    
});

Route::get('/', [BukuController::class, 'index'])->name('home');
Route::get('digilib', [UserController::class, 'index'])->name('digilib');
Route::get('digilib/transaksi', [UserController::class, 'transaksi'])->name('digilib.transaksi')->middleware('auth');
Route::put('digilib/cancel/{id_transaksi}', [UserController::class, 'cancel'])->name('digilib.cancel');
Route::get('/digilib/print-invoice/{id_transaksi}', [UserController::class, 'printInvoice'])->name('digilib.printInvoice');
Route::get('digilib/{id_pustaka}', [UserController::class, 'show'])->name('digilib.show');
Route::get('digilib/create/{id_pustaka}', [UserController::class, 'create'])->name('digilib.create')->middleware('auth');
Route::post('digilib/store', [UserController::class, 'store'])->name('digilib.store');

Route::post('/anggota/import', function () {
    $file = request()->file('file');
    Excel::import(new AnggotaImport, $file);

    return redirect()->route('filament.resources.anggota.index')->with('success', 'Anggota Imported Successfully');
})->name('anggota.import');
