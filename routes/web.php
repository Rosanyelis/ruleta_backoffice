<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CombinacionesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ResponsablesController;

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


Route::get('/combinaciones', [CombinacionesController::class, 'index']);
Route::get('/combinaciones/crear-combinacion', [CombinacionesController::class, 'create']);
Route::post('/combinaciones/guardar-combinacion', [CombinacionesController::class, 'store']);
Route::get('/combinaciones/{id}/editar-combinacion', [CombinacionesController::class, 'edit']);
Route::put('/combinaciones/{id}/actualizar-combinacion', [CombinacionesController::class, 'update']);
Route::delete('/combinaciones/{id}/eliminar-combinacion', [CombinacionesController::class, 'destroy']);

Route::get('/usuarios', [UsuariosController::class, 'index']);
Route::get('/usuarios/nuevo-usuario', [UsuariosController::class, 'create']);
Route::post('/usuarios/guardar-usuario', [UsuariosController::class, 'store']);
Route::get('/usuarios/{id}/editar-usuario', [UsuariosController::class, 'edit']);
Route::put('/usuarios/{id}/actualizar-usuario', [UsuariosController::class, 'update']);
Route::delete('/usuarios/{id}/eliminar-usuario', [UsuariosController::class, 'destroy']);

Route::get('/responsables', [ResponsablesController::class, 'index']);
Route::get('/responsables/nuevo-responsable', [ResponsablesController::class, 'create']);
Route::post('/responsables/guardar-responsable', [ResponsablesController::class, 'store']);
Route::get('/responsables/{id}/editar-responsable', [ResponsablesController::class, 'edit']);
Route::put('/responsables/{id}/actualizar-responsable', [ResponsablesController::class, 'update']);
Route::delete('/responsables/{id}/eliminar-responsable', [ResponsablesController::class, 'destroy']);