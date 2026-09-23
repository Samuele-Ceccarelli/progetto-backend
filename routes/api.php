<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PraticaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Creare un cliente
Route::post('/clienti', [ClienteController::class, 'aggiungiCliente']);

// Creare una pratica
Route::post('/pratiche', [PraticaController::class, 'aggiungiPratica']);

// Elencare le pratiche - Filtrare le pratiche per stato
Route::get('/pratiche', [PraticaController::class, 'visualizzaPratiche']);

// Visualizzare una pratica
Route::get('/pratiche/{pratica}', [PraticaController::class, 'visualizzaPratica']);

// Modificare lo stato di una pratica
Route::patch('/pratiche/{pratica}/stato', [PraticaController::class, 'modificaStatoPratica']);