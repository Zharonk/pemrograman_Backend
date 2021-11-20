<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Models\Student;
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
    #index student
    Route::get('/students', [StudentController::class, 'index']);

    #nambah data
    Route::post('/students', [StudentController::class, 'store']);

    #menampilkan detail data
    Route::get('/students/{id}', [StudentController::class, 'show']);

    #update data
    Route::put('/students/{id}', [StudentController::class, 'update']);

    #hapus data
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
});

#Endpoint buat regis dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Route::get('/animals', [AnimalController::class,'index']);

// #method nambah
// Route::post('/animals', [AnimalController::class,'store']);

// #method edit
// Route::put('/animals/{id}', [AnimalController::class,'update']);

// #method delete
// Route::delete('/animals/{id}', [AnimalController::class,'destroy']);
