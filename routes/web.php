<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('room.index');
});
Route::get('/rooms', [RoomController::class, 'index'])->name('room.index');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('room.show');
Route::get('reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('reservation', [ReservationController::class, 'store'])->name('reservation.store');
