<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ResponsablesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\WebsController;
use App\Http\Controllers\PlantillaHorariosController;
use App\Http\Controllers\PlantillaJugadasController;
use App\Http\Controllers\PlantillaRuletasController;
use App\Http\Controllers\RuletasController;
use App\Http\Controllers\HorasController;
use App\Http\Controllers\JugadasController;

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

# Responsables

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
Route::get('/responsables/{id}/plantilla-responsables/asignar-plantillas', [ResponsablesController::class, 'plantilla']);
Route::post('/responsables/{id}/plantilla-responsables/guardar-plantillas', [ResponsablesController::class, 'guardarPlantilla']);

# Clientes

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

# Plantillas de Horarios

Route::get('/plantilla-de-horarios', [PlantillaHorariosController::class, 'index']);
Route::get('/plantilla-de-horarios/nueva-plantilla-de-horarios', [PlantillaHorariosController::class, 'create']);
Route::post('/plantilla-de-horarios/guardar-plantilla-de-horarios', [PlantillaHorariosController::class, 'store']);
Route::get('/plantilla-de-horarios/{id}/ver-plantilla-de-horarios', [PlantillaHorariosController::class, 'show']);
Route::get('/plantilla-de-horarios/{id}/editar-plantilla-de-horarios', [PlantillaHorariosController::class, 'edit']);
Route::put('/plantilla-de-horarios/{id}/actualizar-plantilla-de-horarios', [PlantillaHorariosController::class, 'update']);
Route::delete('/plantilla-de-horarios/{id}/eliminar-plantilla-de-horarios', [PlantillaHorariosController::class, 'destroy']);

# Plantillas de horarios - Hora

Route::get('/plantilla-de-horarios/configurar-horas', [HorasController::class, 'index']);
Route::get('/plantilla-de-horarios/configurar-horas/nueva-hora', [HorasController::class, 'create']);
Route::post('/plantilla-de-horarios/configurar-horas/guardar-hora', [HorasController::class, 'store']);
Route::get('/plantilla-de-horarios/configurar-horas/{id}/ver-hora', [HorasController::class, 'show']);
Route::get('/plantilla-de-horarios/configurar-horas/{id}/editar-hora', [HorasController::class, 'edit']);
Route::put('/plantilla-de-horarios/configurar-horas/{id}/actualizar-hora', [HorasController::class, 'update']);
Route::delete('/plantilla-de-horarios/configurar-horas/{id}/eliminar-hora', [HorasController::class, 'destroy']);

# Plantillas de Jugadas

Route::get('/plantilla-de-jugadas', [PlantillaJugadasController::class, 'index']);
Route::get('/plantilla-de-jugadas/nueva-plantilla-de-jugadas', [PlantillaJugadasController::class, 'create']);
Route::post('/plantilla-de-jugadas/guardar-plantilla-de-jugadas', [PlantillaJugadasController::class, 'store']);
Route::get('/plantilla-de-jugadas/{id}/ver-plantilla-de-jugadas', [PlantillaJugadasController::class, 'show']);
Route::get('/plantilla-de-jugadas/{id}/editar-plantilla-de-jugadas', [PlantillaJugadasController::class, 'edit']);
Route::put('/plantilla-de-jugadas/{id}/actualizar-plantilla-de-jugadas', [PlantillaJugadasController::class, 'update']);
Route::delete('/plantilla-de-jugadas/{id}/eliminar-plantilla-de-jugadas', [PlantillaJugadasController::class, 'destroy']);

# Plantillas de jugadas - Jugadas

Route::get('/plantilla-de-jugadas/configurar-jugadas', [JugadasController::class, 'index']);
Route::get('/plantilla-de-jugadas/configurar-jugadas/nueva-jugada', [JugadasController::class, 'create']);
Route::post('/plantilla-de-jugadas/configurar-jugadas/guardar-jugada', [JugadasController::class, 'store']);
Route::get('/plantilla-de-jugadas/configurar-jugadas/{id}/ver-jugada', [JugadasController::class, 'show']);
Route::get('/plantilla-de-jugadas/configurar-jugadas/{id}/editar-jugada', [JugadasController::class, 'edit']);
Route::put('/plantilla-de-jugadas/configurar-jugadas/{id}/actualizar-jugada', [JugadasController::class, 'update']);
Route::delete('/plantilla-de-jugadas/configurar-jugadas/{id}/eliminar-jugada', [JugadasController::class, 'destroy']);

# Plantillas de Ruletas

Route::get('/plantilla-de-ruletas', [PlantillaRuletasController::class, 'index']);
Route::get('/plantilla-de-ruletas/nueva-plantilla-de-ruletas', [PlantillaRuletasController::class, 'create']);
Route::post('/plantilla-de-ruletas/guardar-plantilla-de-ruletas', [PlantillaRuletasController::class, 'store']);
Route::get('/plantilla-de-ruletas/{id}/ver-plantilla-de-ruletas', [PlantillaRuletasController::class, 'show']);
Route::get('/plantilla-de-ruletas/{id}/editar-plantilla-de-ruletas', [PlantillaRuletasController::class, 'edit']);
Route::put('/plantilla-de-ruletas/{id}/actualizar-plantilla-de-ruletas', [PlantillaRuletasController::class, 'update']);
Route::delete('/plantilla-de-ruletas/{id}/eliminar-plantilla-de-ruletas', [PlantillaRuletasController::class, 'destroy']);

# Plantillas de ruletas - Ruletas

Route::get('/plantilla-de-ruletas/configurar-ruletas', [RuletasController::class, 'index']);
Route::get('/plantilla-de-ruletas/configurar-ruletas/nueva-ruleta', [RuletasController::class, 'create']);
Route::post('/plantilla-de-ruletas/configurar-ruletas/guardar-ruleta', [RuletasController::class, 'store']);
Route::get('/plantilla-de-ruletas/configurar-ruletas/{id}/ver-ruleta', [RuletasController::class, 'show']);
Route::get('/plantilla-de-ruletas/configurar-ruletas/{id}/editar-ruleta', [RuletasController::class, 'edit']);
Route::put('/plantilla-de-ruletas/configurar-ruletas/{id}/actualizar-ruleta', [RuletasController::class, 'update']);
Route::delete('/plantilla-de-ruletas/configurar-ruletas/{id}/eliminar-ruleta', [RuletasController::class, 'destroy']);

# Plantillas de Usuarios

Route::get('/usuarios', [UsuariosController::class, 'index']);
Route::get('/usuarios/nuevo-usuario', [UsuariosController::class, 'create']);
Route::post('/usuarios/guardar-usuario', [UsuariosController::class, 'store']);
Route::get('/usuarios/{id}/ver-perfil-de-usuario', [UsuariosController::class, 'show']);
Route::get('/usuarios/{id}/editar-usuario', [UsuariosController::class, 'edit']);
Route::put('/usuarios/{id}/actualizar-usuario', [UsuariosController::class, 'update']);
Route::delete('/usuarios/{id}/eliminar-usuario', [UsuariosController::class, 'destroy']);