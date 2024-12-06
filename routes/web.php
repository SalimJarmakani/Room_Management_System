<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Rooms\RoomController;
use App\Http\Controllers\Rooms\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->prefix('rooms')->group(function () {
    Route::get('/', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/calendar', [RoomController::class, 'showCalendar'])->name('rooms.calendar');
    Route::get('/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/search', [RoomController::class, 'search'])->name('rooms.search');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/book-room', [BookingController::class, 'showBookingForm'])->name('book-room.form');
    Route::post('/book-room', [BookingController::class, 'store'])->name('book-room.store');
});
require __DIR__ . '/auth.php';
