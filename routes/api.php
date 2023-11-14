<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('/items', [ProductoController::class, 'index']);
Route::get('/item/{id}', [ProductoController::class, 'show']);
Route::post('/item', [ProductoController::class, 'store']);
Route::put('/item/{id}', [ProductoController::class, 'update']);
