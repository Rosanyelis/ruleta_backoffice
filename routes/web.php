<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ResponsablesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\WebsController;
use App\Http\Controllers\MoldeHorariosController;
use App\Http\Controllers\MoldeJugadasController;
use App\Http\Controllers\MoldeRuletasController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/usuarios', [UsuariosController::class, 'index']);
Route::get('/usuarios/nuevo-usuario', [UsuariosController::class, 'create']);
Route::post('/usuarios/guardar-usuario', [UsuariosController::class, 'store']);
Route::get('/usuarios/{id}/ver-perfil-de-usuario', [UsuariosController::class, 'show']);
Route::get('/usuarios/{id}/editar-usuario', [UsuariosController::class, 'edit']);
Route::put('/usuarios/{id}/actualizar-usuario', [UsuariosController::class, 'update']);
Route::delete('/usuarios/{id}/eliminar-usuario', [UsuariosController::class, 'destroy']);

Route::get('/responsables', [ResponsablesController::class, 'index']);
Route::get('/responsables/nuevo-responsable', [ResponsablesController::class, 'create']);
Route::post('/responsables/guardar-responsable', [ResponsablesController::class, 'store']);
Route::get('/responsables/{id}/ver-perfil-de-responsable', [ResponsablesController::class, 'show']);
Route::get('/responsables/{id}/editar-responsable', [ResponsablesController::class, 'edit']);
Route::put('/responsables/{id}/actualizar-responsable', [ResponsablesController::class, 'update']);
Route::delete('/responsables/{id}/eliminar-responsable', [ResponsablesController::class, 'destroy']);
Route::get('/responsables/{id}/ver-perfil-de-responsable/asignar-usuario', [ResponsablesController::class, 'usuario']);
Route::post('/responsables/{id}/ver-perfil-de-responsable/guardar-usuario', [ResponsablesController::class, 'guardar']);
Route::get('/responsables/{id}/ver-perfil-de-responsable/crear-cliente', [ResponsablesController::class, 'cliente']);
Route::post('/responsables/{id}/ver-perfil-de-responsable/guardar-cliente', [ResponsablesController::class, 'guardarCliente']);

Route::get('/clientes', [ClientesController::class, 'index']);
Route::get('/clientes/nuevo-cliente', [ClientesController::class, 'create']);
Route::post('/clientes/guardar-cliente', [ClientesController::class, 'store']);
Route::get('/clientes/{id}/ver-perfil-de-cliente', [ClientesController::class, 'show']);
Route::get('/clientes/{id}/editar-cliente', [ClientesController::class, 'edit']);
Route::put('/clientes/{id}/actualizar-cliente', [ClientesController::class, 'update']);
Route::delete('/clientes/{id}/eliminar-cliente', [ClientesController::class, 'destroy']);
Route::get('/clientes/{id}/ver-perfil-de-cliente/asignar-usuario', [ClientesController::class, 'usuario']);
Route::post('/clientes/{id}/ver-perfil-de-cliente/guardar-usuario', [ClientesController::class, 'guardar']);
Route::get('/clientes/{id}/ver-perfil-de-cliente/crear-taquilla', [ClientesController::class, 'cliente']);
Route::post('/clientes/{id}/ver-perfil-de-cliente/guardar-taquilla', [ClientesController::class, 'guardarCliente']);


Route::get('/plantilla-de-horarios', [MoldeHorariosController::class, 'index']);
Route::get('/plantilla-de-horarios/nueva-plantilla-de-horarios', [MoldeHorariosController::class, 'create']);
Route::post('/plantilla-de-horarios/guardar-plantilla-de-horarios', [MoldeHorariosController::class, 'store']);
Route::get('/plantilla-de-horarios/{id}/ver-plantilla-de-horarios', [MoldeHorariosController::class, 'show']);
Route::get('/plantilla-de-horarios/{id}/editar-plantilla-de-horarios', [MoldeHorariosController::class, 'edit']);
Route::put('/plantilla-de-horarios/{id}/actualizar-plantilla-de-horarios', [MoldeHorariosController::class, 'update']);
Route::delete('/plantilla-de-horarios/{id}/eliminar-plantilla-de-horarios', [MoldeHorariosController::class, 'destroy']);


Route::get('/plantilla-de-jugadas', [MoldeJugadasController::class, 'index']);
Route::get('/plantilla-de-jugadas/nueva-plantilla-de-jugadas', [MoldeJugadasController::class, 'create']);
Route::post('/plantilla-de-jugadas/guardar-plantilla-de-jugadas', [MoldeJugadasController::class, 'store']);
Route::get('/plantilla-de-jugadas/{id}/editar-plantilla-de-jugadas', [MoldeJugadasController::class, 'edit']);
Route::put('/plantilla-de-jugadas/{id}/actualizar-plantilla-de-jugadas', [MoldeJugadasController::class, 'update']);
Route::delete('/plantilla-de-jugadas/{id}/eliminar-plantilla-de-jugadas', [MoldeJugadasController::class, 'destroy']);

Route::get('/plantilla-de-ruletas', [MoldeRuletasController::class, 'index']);
Route::get('/plantilla-de-ruletas/nueva-plantilla-de-ruletas', [MoldeRuletasController::class, 'create']);
Route::post('/plantilla-de-ruletas/guardar-plantilla-de-ruletas', [MoldeRuletasController::class, 'store']);
Route::get('/plantilla-de-ruletas/{id}/editar-plantilla-de-ruletas', [MoldeRuletasController::class, 'edit']);
Route::put('/plantilla-de-ruletas/{id}/actualizar-plantilla-de-ruletas', [MoldeRuletasController::class, 'update']);
Route::delete('/plantilla-de-ruletas/{id}/eliminar-plantilla-de-ruletas', [MoldeRuletasController::class, 'destroy']);