<?php

use App\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/layouts', function () {
    return view('layouts.index');
})->name('index');

/*Crear usuarios desde el admin*/
// Mostrar Pagina.
Route::get('/personas', [PersonaController::class, 'index'])->name('personas.index')->middleware('auth');
//Cargar DataTable mediante AJAX.
Route::get('/personas/cargarDatos', [PersonaController::class, 'cargarDatos']);
//Guardar Datos
Route::post('/personas/store', [PersonaController::class, 'store'])->name('personas.store');
//Eliminar Datos
Route::get('/personas/delete/{id}', [PersonaController::class, 'destroy']);
//Cargar Datos a Editar
Route::get('/personas/edit/{id}', [PersonaController::class, 'edit']);
//Actualizando Datos
Route::put('/personas/update', [PersonaController::class, 'update'])->name('personas.update');

