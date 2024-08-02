<?php

use App\Http\Controllers\ConversaoController;
use Illuminate\Support\Facades\Route;

Route::post('/conversoes', [ConversaoController::class, 'store']);
Route::get('/conversoes/{id}', [ConversaoController::class, 'show']);
Route::post('/conversoes/romano', [ConversaoController::class, 'convertRomano']);
