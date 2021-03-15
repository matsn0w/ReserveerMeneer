<?php

use App\Http\Controllers\CinemaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantReservationController;
use App\Models\RestaurantReservation;
use Illuminate\Support\Facades\Route;

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

Route::resource('restaurants', RestaurantController::class);
Route::get('/restaurants/{id}/reserve', [RestaurantReservationController::class, 'index']);

Route::resource('events', EventController::class);

Route::resource('cinemas', CinemaController::class);
Route::resource('halls', HallController::class);
Route::resource('movies', MovieController::class);
