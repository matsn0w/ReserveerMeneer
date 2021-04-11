<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilmEventController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\EventReservationController;
use App\Http\Controllers\FilmEventReservationController;
use App\Http\Controllers\RestaurantReservationController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events-overview/{sort?}{dateFrom?}{dateTill?}', [HomeController::class, 'events'])->name('home.events');

Route::resources([
    'restaurants' => RestaurantController::class,
    'events' => EventController::class,
    'cinemas' => CinemaController::class,
    'halls' => HallController::class,
    'movies' => MovieController::class,
    'filmevents' => FilmEventController::class
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/restaurants/{id}/reserve', [RestaurantReservationController::class, 'reserve'])->name('restaurantreservations.reserve');
    Route::put('/restaurants/{id}/reserve', [RestaurantReservationController::class, 'store'])->name('restaurantreservations.store');

    Route::get('/events/{id}/reserve/{locale?}', [EventReservationController::class, 'reserve'])->name('eventreservations.reserve');
    Route::get('/events/{id}/reserve/{locale}', [EventReservationController::class, 'setLocale'])->name('eventreservations.locale');
    Route::post('/events/{id}/reserve/{locale?}', [EventReservationController::class, 'nextStep'])->name('eventreservations.next');
    Route::put('/events/{id}/reserve', [EventReservationController::class, 'store'])->name('eventreservations.store');

    Route::get('/filmevents/{filmevent}/reserve', [FilmEventReservationController::class, 'reserve'])->name('filmeventreservations.reserve');
    Route::put('/filmevents/{filmevent}/reserve', [FilmEventReservationController::class, 'store'])->name('filmeventreservations.store');

    Route::get('/myreservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/myreservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::get('/myreservations/{reservation}/export/CSV', [ReservationController::class, 'exportToCSV'])->name('reservations.exportCSV');
    Route::get('/myreservations/{reservation}/export/JSON', [ReservationController::class, 'exportToJSON'])->name('reservations.exportJSON');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('role:ADMIN');
    Route::get('/dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter')->middleware('role:ADMIN');;
});
