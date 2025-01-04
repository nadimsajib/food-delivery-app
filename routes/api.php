<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiderTrackingController;
use App\Http\Controllers\ProductController;

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

Route::post('/save-rider-info', [RiderTrackingController::class, 'saveRiderInfo']);


Route::get('/nearest-rider/{restaurant_id}', [RiderTrackingController::class, 'getNearestRider']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/add-product', [ProductController::class, 'saveProduct']);

Route::post('/add-product-cat', [ProductController::class, 'saveProductCat']);

Route::get('/products', [ProductController::class, 'getProduct']);

