<?php

use App\Http\Controllers\ApiAuthTaquillaController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login-taquilla', [ApiAuthTaquillaController::class, 'login']);
Route::post('/info-usuario', [ApiAuthTaquillaController::class, 'infoUser'])->middleware('auth.sanctum');


