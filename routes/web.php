<?php

use App\Models\EventReservation;
use App\Models\RestaurantReservation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\FilmEventController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\EventReservationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RestaurantReservationController;
use App\Models\Reservation;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/restaurants/{id}/reserve', [RestaurantReservationController::class, 'reserve'])
        ->name('restaurantreservations.reserve');
    Route::put('/restaurants/{id}/reserve', [RestaurantReservationController::class, 'store'])
        ->name('restaurantreservations.store');

    Route::get('/events/{id}/reserve', [EventReservationController::class, 'reserve'])
        ->name('eventreservations.reserve');
    Route::post('/events/{id}/reserve', [EventReservationController::class, 'nextStep'])
        ->name('eventreservations.next');
    Route::put('/events/{id}/reserve/', [EventReservationController::class, 'store'])
        ->name('eventreservations.store');

    Route::get('/filmevents/{filmevent}/reserve', [FilmEventController::class, 'reserve'])
        ->name('filmevents.reserve');
    Route::put('/filmevents/{filmevent}/reserve', [FilmEventController::class, 'store'])
        ->name('filmevents.store');

    Route::resources([
        'restaurants' => RestaurantController::class,
        'events' => EventController::class,
        'cinemas' => CinemaController::class,
        'halls' => HallController::class,
        'movies' => MovieController::class,
        'filmevents' => FilmEventController::class
    ]);

    Route::resource('filmevents', FilmEventController::class)->except(['index']);
    Route::get('/myreservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/myreservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::get('/myreservations/{reservation}/export', [ReservationController::class, 'export'])->name('reservations.export');
});
