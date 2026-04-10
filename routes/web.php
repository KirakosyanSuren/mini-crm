<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feedback-widget', [TicketController::class, 'create']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'sign'])->name('sign');
});

//Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {


});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');
        Route::get('/ticket/{id}', [TicketController::class, 'show'])->name('ticket.show');
        Route::patch('/tickets/{id}/status', [TicketController::class, 'updateStatus'])
            ->name('ticket.updateStatus');
    });

});
