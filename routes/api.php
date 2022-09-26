<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\RaceController;

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


Route::get('/pet', [PetController::class, 'index']);
Route::get('/pet/{pet}', [PetController::class, 'show']);
Route::post('/pet/store', [PetController::class, 'store']);
Route::post('/pet/update/{pet}', [PetController::class, 'update']);
Route::delete('/pet/delete/{pet}', [PetController::class, 'destroy']);



Route::get('/race', [RaceController::class, 'index']);