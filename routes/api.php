<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Crud\CategoriaController;
use App\Http\Controllers\Crud\ItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// CRUD..
    // Categoria..
    Route::post('categorias/index', [CategoriaController::class, 'index']);
    Route::post('categorias/store', [CategoriaController::class, 'store']);
    Route::post('categorias/update', [CategoriaController::class, 'update']);
    Route::post('categorias/destroy', [CategoriaController::class, 'destroy']);

    // Item..
    Route::post('items/index', [ItemController::class, 'index']);
    Route::post('items/store', [ItemController::class, 'store']);
    Route::post('items/update', [ItemController::class, 'update']);
    Route::post('items/destroy', [ItemController::class, 'destroy']);