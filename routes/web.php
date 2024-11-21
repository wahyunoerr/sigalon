<?php

use App\Http\Controllers\GalonController;
use App\Http\Controllers\IsiUlangController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\StatusAntarController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
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


Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::controller(GalonController::class)->group(function () {
        Route::prefix('galon')->group(function () {
            Route::get('/', 'index')->name('galon');
            Route::get('/create', 'create')->name('galon.create');
            Route::get('/edit/{galon}', 'edit')->name('galon.edit');
            Route::post('/save', 'store')->name('galon.save');
            Route::post('/update/{galon}', 'update')->name('galon.update');
            Route::delete('/delete/{galon}', 'destroy')->name('galon.delete');
        });
    });

    Route::controller(StatusAntarController::class)->group(function () {
        Route::prefix('statusA')->group(function () {
            Route::get('/', 'index')->name('antar');
            Route::get('/add', 'create')->name('antar.create');
            Route::get('/edit/{statusAntar}', 'edit')->name('antar.edit');
            Route::post('/save', 'store')->name('antar.save');
            Route::post('/update/{statusAntar}', 'update')->name('antar.update');
            Route::delete('/delete/{statusAntar}', 'destroy')->name('antar.delete');
        });
    });

    Route::controller(TransaksiController::class)->group(function () {
        Route::prefix('transaksi')->group(function () {
            Route::get('/', 'index')->name('transaksi');
            Route::get('/add', 'create')->name('transaksi.create');
            Route::get('/edit/{transaksi}', 'edit')->name('transaksi.edit');
            Route::post('/save', 'store')->name('transaksi.save');
            Route::post('/update/{transaksi}', 'update')->name('transaksi.update');
            Route::delete('/delete/{transaksi}', 'destroy')->name('transaksi.destroy');
        });
    });

    Route::controller(IsiUlangController::class)->group(function () {
        Route::prefix('isi-ulang')->group(function () {
            Route::get('/', 'index')->name('isiUlang');
            Route::post('/save', 'store')->name('isiUlang.save');
        });
    });

    Route::controller(PengeluaranController::class)->group(function () {
        Route::prefix('pengeluaran')->group(function () {
            Route::get('/', 'index')->name('pengeluaran');
            Route::get('/create', 'create')->name('pengeluaran.create');
            Route::get('/edit/{pengeluaran}', 'create')->name('pengeluaran.edit');
            Route::post('/save', 'store')->name('pengeluaran.save');
            Route::post('/update/{pengeluaran}', 'update')->name('pengeluaran.update');
            Route::delete('/delete/{pengeluaran}', 'destroy')->name('pengeluaran.destroy');
        });
    });
});
