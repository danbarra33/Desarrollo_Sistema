<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
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

Route::get('/sucursales/agregar', function () {
    return view('sucursales.agregar');
})->name('sucursalesAgregar')->middleware('auth');
