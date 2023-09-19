<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\OficioController;
use App\Http\Controllers\PersonaController;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//CRUD PERSONA
Route::get('personas/getall', [PersonaController::class, 'mostrarTodo']);
Route::post('personas/create', [PersonaController::class, 'crear']);
Route::delete('personas/{id}', [PersonaController::class, 'eliminar']);
Route::put('personas/{id}', [PersonaController::class, 'actualizar']);
//CRUD CATEGORIA
Route::get('categorias/getall', [CategoriaController::class, 'mostrarTodo']);
Route::post('categorias/create', [CategoriaController::class, 'crear']);
Route::delete('categorias/{id}', [CategoriaController::class, 'eliminar']);
Route::put('categorias/{id}', [CategoriaController::class, 'actualizar']);
//CRUD OFICIO
Route::get('oficios/getall', [OficioController::class, 'mostrarTodo']);
Route::post('oficios/create', [OficioController::class, 'crear']);
Route::delete('oficios/{id}', [OficioController::class, 'eliminar']);
Route::put('oficios/{id}', [OficioController::class, 'actualizar']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});