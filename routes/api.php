<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/tickets', [TicketController::class, 'store']);
