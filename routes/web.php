<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feedback-widget', [TicketController::class, 'create']);

//Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticket/{id}', [TicketController::class, 'show'])->name('ticket.show');
    Route::patch('/tickets/{id}/status', [TicketController::class, 'updateStatus'])
        ->name('ticket.updateStatus');
});

