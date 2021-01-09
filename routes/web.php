<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\TiposPagosController;
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
    return view('welcome');
});

Route::get('/clientes', [ClientesController::class, 'listado'])->name('clientesListado')->middleware('auth');

Route::get('/pagos/tipos/listado', [TiposPagosController::class, 'listado'])->name('tiposPagos')->middleware('auth');
Route::get('/pagos/tipos', [TiposPagosController::class, 'index'])->name('indexTiposPagos')->middleware('auth');

Route::post('/clientes/nuevo', [ClientesController::class, 'nuevo'])->name('clientesNuevo')->middleware('auth');
Route::get('/clientes/editar', [ClientesController::class, 'editar'])->name('clientesEditar')->middleware('auth');
Route::post('/clientes/actualizar', [ClientesController::class, 'actualizar'])->name('clientesActualizar')->middleware('auth');

Route::get('/clientes/agregar', function () {
    return view('clients.agregar');
})->name('clientesAgregar')->middleware('auth');

Route::get('/users/perfil', function () {
    return view('users.perfil');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/sucursales', [App\Http\Controllers\SucursalesController::class, 'index'])->name('sucursales')->middleware('auth');

Route::get('/sucursales/listado', [App\Http\Controllers\SucursalesController::class, 'listado'])->name('listadoSucursales')->middleware('auth');

Route::post('/sucursales/crear', [App\Http\Controllers\SucursalesController::class, 'crear'])->name('crearSucursal')->middleware('auth');

Route::post('/sucursales/actualizar', [App\Http\Controllers\SucursalesController::class, 'actualizar'])->name('actualizarSucursal')->middleware('auth');

Route::get('/empleados', [App\Http\Controllers\EmpleadosController::class, 'index'])->name('empleados')->middleware('auth');

Route::get('/empleados/listado', [App\Http\Controllers\EmpleadosController::class, 'listado'])->name('listadoEmpleados')->middleware('auth');

Route::post('/empleados/crear', [App\Http\Controllers\EmpleadosController::class, 'crear'])->name('crearEmpleado')->middleware('auth');

Route::post('/empleados/actualizar', [App\Http\Controllers\EmpleadosController::class, 'actualizar'])->name('actualizarEmpleado')->middleware('auth');

Route::get('/avales', [App\Http\Controllers\AvalesController::class, 'index'])->name('avales')->middleware('auth');

Route::get('/avales/listado', [App\Http\Controllers\AvalesController::class, 'listado'])->name('listadoAvales')->middleware('auth');

Route::post('/avales/crear', [App\Http\Controllers\AvalesController::class, 'crear'])->name('crearAval');//->middleware('auth');

Route::get('/clientes/descargar', [App\Http\Controllers\ClientesController::class, 'descargar'])->name('descargarCliente')->middleware('auth');