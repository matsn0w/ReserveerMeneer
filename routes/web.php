<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\CinemaController;

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
    return view('home');
});

Route::resource('cinemas', CinemaController::class);

Route::name('halls.')->prefix('halls')->group(function () {
    Route::get('/', [HallController::class, 'index'])->name('index');
    Route::get('/{hall}', [HallController::class, 'show'])->name('show');
});
