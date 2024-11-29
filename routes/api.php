<?php
use App\Http\Controllers\CardController;
use App\Http\Controllers\UploadController;


Route::get('/uploads', [UploadController::class, 'index']);
Route::post('/upload', [UploadController::class, 'store']);
Route::post('/cards', [CardController::class, 'store']); // Para criar um novo card
Route::get('/cards', [CardController::class, 'index']);  // Para listar os cards
Route::delete('/cards/{id}', [CardController::class, 'destroy']); // Para deletar um card


Route::post('/upload', [UploadController::class, 'store']);
Route::get('/uploads', [UploadController::class, 'index']);

Route::get('/uploads', [UploadController::class, 'getUploads']); // API para obter os uploads
