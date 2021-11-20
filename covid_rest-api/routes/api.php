<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StatusPatientController;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    #pake resource biar gk bikin route 1 1 (index, store, show, dll)
    Route::apiResource('/patients', PatientController::class);
    #menampilkan data yang dicari by name
    Route::get('/patiens/search/{name}', [PatientController::class, 'search']);
    Route::get('/patients/status/{status}', [PatientController::class, 'getStatus']);

    Route::apiResource('/status', StatusPatientController::class);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
