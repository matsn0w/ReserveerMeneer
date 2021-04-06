<?php

use App\Http\Controllers\CinemaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventReservationController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieReservationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantReservationController;
use App\Models\EventReservation;
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
})->name('home');

Route::resource('restaurants', RestaurantController::class);

Route::get('/restaurants/{id}/reserve', [RestaurantReservationController::class, 'reserve'])
    ->middleware('auth')
    ->name('restaurantreservations.reserve');
Route::put('/restaurants/{id}/reserve', [RestaurantReservationController::class, 'store'])
    ->middleware('auth')
    ->name('restaurantreservations.store');

Route::get('/events/{id}/reserve', [EventReservationController::class, 'reserve'])
    ->middleware('auth')
    ->name('eventreservations.reserve');
Route::put('/events/{id}/reserve', [EventReservationController::class, 'store'])
    ->middleware('auth')
    ->name('eventreservations.store');

Route::get('/movies/{id}/reserve', [MovieReservationController::class, 'reserve'])
    ->middleware('auth')
    ->name('moviereservations.reserve');
Route::put('/movies/{id}/reserve', [RestaurantReservationController::class, 'store'])
    ->middleware('auth')
    ->name('moviereservations.store');

Route::resource('events', EventController::class);
Route::resource('cinemas', CinemaController::class);
Route::resource('halls', HallController::class);
Route::resource('movies', MovieController::class);
