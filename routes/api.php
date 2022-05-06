<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SupportedModelController;
use App\Http\Controllers\Api\ShippingCompanyController;
use App\Http\Controllers\Api\PriceController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\ConfigurationController;

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
Route::apiResource('shippingCompanies', ShippingCompanyController::class);
Route::apiResource('banks', BankController::class);
Route::apiResource('configurations', ConfigurationController::class);
Route::post('supportedModels/check', [SupportedModelController::class, 'check'])->name('supportedModel.check');
Route::post('prices/check', [PriceController::class, 'check'])->name('prices.check');
Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');