<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NumberOneController;
use App\Http\Controllers\Api\NumberTwoController;
use App\Http\Controllers\Api\NumberFourController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('number_one', [NumberOneController::class, 'index']);
Route::post('number_two', [NumberTwoController::class, 'index']);

Route::get('number_four/{type}', [NumberFourController::class, 'read']);
Route::post('number_four/{type}', [NumberFourController::class, 'create']);
Route::put('number_four/{type}', [NumberFourController::class, 'update']);
Route::delete('number_four/{type}', [NumberFourController::class, 'delete']);