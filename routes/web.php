<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;


Route::get('/', [DashboardController::class, 'index']);
 
Route::resource('tickets', TicketController::class);
Route::post('/tickets-filter', [TicketController::class, 'ticketsFilter']);
Route::get('/tickets-filter', [TicketController::class, 'ticketsFilter']);
