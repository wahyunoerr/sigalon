<?php

use App\Http\Controllers\GalonController;
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
