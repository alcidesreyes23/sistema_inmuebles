<?php

use App\Http\Controllers\BinnacleController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ResidenceAreaController;
use App\Http\Controllers\SuburbController;
use App\Http\Controllers\TaxTypeController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTaxController;
use App\Http\Controllers\PropertyTaxPaymentController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\SubdivisionTaxController;
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

/************************************************************************/
/*****************************VIEW INICIAL*******************************/
/************************************************************************/

Route::get('/', function () {
    return view('auth.login');
});

/************************************************************************/
/****************************AUTENTICACION*******************************/
/************************************************************************/

Route::middleware(['auth:sanctum', 'verified'])->get('/layouts', function () {
    return view('layouts.index');
})->name('index');


/************************************************************************/
/***********************USUARIOS CRUD ADMIN******************************/
/************************************************************************/

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


/************************************************************************/
/***************CIUDADANOS CRUD ADMIN-JEFE-AUXILIAR**********************/
/************************************************************************/

Route::get('/citizens',[CitizenController::class,'index'])->name('citizens.index')->middleware('auth');
Route::get('/citizens/cargarDatos', [CitizenController::class, 'cargarDatos']);
Route::post('/citizens/store', [CitizenController::class, 'store'])->name('citizens.store');
Route::get('/citizens/delete/{id}', [CitizenController::class, 'destroy']);
Route::get('/citizens/edit/{id}', [CitizenController::class, 'edit']);
Route::put('/citizens/update', [CitizenController::class, 'update'])->name('citizens.update');

/************************************************************************/
/***************TAX TYPES CRUD ADMIN**********************/
/************************************************************************/
Route::get('/tax-types', [TaxTypeController::class, 'index'])->name('taxtypes.index')->middleware('auth');
Route::get('/tax-types/show', [TaxTypeController::class, 'show']);
Route::post('/tax-types/store', [TaxTypeController::class, 'store'])->name('taxtypes.store');
Route::get('/tax-types/delete/{id}', [TaxTypeController::class, 'destroy']);
Route::get('/tax-types/edit/{id}', [TaxTypeController::class, 'edit']);
Route::put('/tax-types/update', [TaxTypeController::class, 'update'])->name('taxtypes.update');

/************************************************************************/
/***************TAX CRUD ADMIN**********************/
/************************************************************************/
Route::get('/tax', [TaxController::class, 'index'])->name('tax.index')->middleware('auth');
Route::get('/tax/show', [TaxController::class, 'show']);
Route::post('/tax/store', [TaxController::class, 'store'])->name('tax.store');
Route::get('/tax/delete/{id}', [TaxController::class, 'destroy']);
Route::get('/tax/edit/{id}', [TaxController::class, 'edit']);
Route::put('/tax/update', [TaxController::class, 'update'])->name('tax.update');

/************************************************************************/
/***************SUBURB CRUD ADMIN**********************/
/************************************************************************/
Route::get('/suburb', [SuburbController::class, 'index'])->name('suburb.index')->middleware('auth');
Route::get('/suburb/show', [SuburbController::class, 'show']);
Route::post('/suburb/store', [SuburbController::class, 'store'])->name('suburb.store');
Route::get('/suburb/delete/{id}', [SuburbController::class, 'destroy']);
Route::get('/suburb/edit/{id}', [SuburbController::class, 'edit']);
Route::put('/suburb/update', [SuburbController::class, 'update'])->name('suburb.update');

/************************************************************************/
/***************RESIDENCE AREA CRUD ADMIN**********************/
/************************************************************************/
Route::get('/residence-area', [ResidenceAreaController::class, 'index'])->name('residencearea.index')->middleware('auth');
Route::get('/residence-area/show', [ResidenceAreaController::class, 'show']);
Route::post('/residence-area/store', [ResidenceAreaController::class, 'store'])->name('residencearea.store');
Route::get('/residence-area/delete/{id}', [ResidenceAreaController::class, 'destroy']);
Route::get('/residence-area/edit/{id}', [ResidenceAreaController::class, 'edit']);
Route::put('/residence-area/update', [ResidenceAreaController::class, 'update'])->name('residencearea.update');

/************************************************************************/
/***************PROPERTY TYPE CRUD ADMIN**********************/
/************************************************************************/
Route::get('/property-type', [PropertyTypeController::class, 'index'])->name('propertytype.index')->middleware('auth');
Route::get('/property-type/show', [PropertyTypeController::class, 'show']);
Route::post('/property-type/store', [PropertyTypeController::class, 'store'])->name('propertytype.store');
Route::get('/property-type/delete/{id}', [PropertyTypeController::class, 'destroy']);
Route::get('/property-type/edit/{id}', [PropertyTypeController::class, 'edit']);
Route::put('/property-type/update', [PropertyTypeController::class, 'update'])->name('propertytype.update');

/************************************************************************/
/***************BINNACLE CRUD ADMIN**********************/
/************************************************************************/
Route::get('/binnacle', [BinnacleController::class, 'index'])->name('binnacle.index')->middleware('auth');
Route::get('/binnacle/show', [BinnacleController::class, 'show']);


/***************INMUEBLES CRUD ADMIN-JEFE-AUXILIAR**********************/
/************************************************************************/

Route::get('/properties',[PropertyController::class,'index'])->name('properties.index');
Route::get('/properties/cargarDetalle/{id}', [PropertyController::class, 'cargarDetalle']);
Route::get('/properties/detalles/{id}', [PropertyController::class, 'detalles'])->name('properties.index2');
Route::get('/properties/edit/{id}', [PropertyController::class, 'edit']);
Route::post('/properties/store', [PropertyController::class, 'store'])->name('properties.store');
Route::put('/properties/update', [PropertyController::class, 'update'])->name('properties.update');
Route::get('/properties/delete/{id}', [PropertyController::class, 'destroy']);



/***************   PAGOS DE TAXES**********************/
/************************************************************************/
Route::get('/payment',[PaymentController::class,'index'])->name('pagos.index');
Route::get('/payment/bill/{id}',[PaymentController::class,'factura'])->name('pagos.factura');
Route::post('/payment/store', [PaymentController::class, 'store'])->name('pagos.store');
Route::get('/payment/get-sub/{id}',[PaymentController::class,'getSubT']);
Route::post('/payment/calculate', [PaymentController::class, 'calculate']);
Route::get('/payment/detalles/{id}',[PaymentController::class,'detalles'])->name('pagos.detalle');
Route::get('/payment/cancelar-pago/{id}',[PaymentController::class,'edit'])->name('pagos.edit');
Route::put('/payment/update', [PaymentController::class, 'update'])->name('pagos.update');

/************************************************************************/
/***************    SUBDIVISION TAX CRUD ADMIN**********************/
/************************************************************************/
Route::get('/subdivision-tax', [SubdivisionTaxController::class, 'index'])->name('subdivisiontax.index')->middleware('auth');
Route::get('/subdivision-tax/show', [SubdivisionTaxController::class, 'show']);
Route::post('/subdivision-tax/store', [SubdivisionTaxController::class, 'store'])->name('subdivisiontax.store');
Route::get('/subdivision-tax/delete/{id}', [SubdivisionTaxController::class, 'destroy']);
Route::get('/subdivision-tax/edit/{id}', [SubdivisionTaxController::class, 'edit']);
Route::put('/subdivision-tax/update', [SubdivisionTaxController::class, 'update'])->name('subdivisiontax.update');


/************************************************************************/
/***************** PROPERTY STATUS   ************************************/
/************************************************************************/
Route::get('/property-status',[PropertyTaxController::class,'index'])->name('property-status.index');
Route::get('/property-status/detalles/{id}', [PropertyTaxController::class, 'detalles'])->name('property-status.detalles');