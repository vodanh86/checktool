<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SupportedModelController;
use App\Http\Controllers\Api\PriceController;

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
Route::apiResource('supportedModels', SupportedModelController::class);
Route::post('supportedModels/check', [SupportedModelController::class, 'check'])->name('supportedModel.check');
Route::post('price/check', [PriceController::class, 'check'])->name('price.check');