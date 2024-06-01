<?php

use App\Http\Controllers\Api\ApiTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Ticket;





Route::get('tickets', [ApiTicketController::class, 'index']);

Route::get('tickets/{id}', [ApiTicketController::class, 'show']);

Route::post('tickets', [ApiTicketController::class, 'store']);

Route::put('tickets/{id}', [ApiTicketController::class, 'update']);

Route::delete('tickets/{id}', [ApiTicketController::class, 'destroy']);
