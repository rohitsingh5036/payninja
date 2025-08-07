<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/orders/initiate', [OrderController::class, 'initiate']);
Route::post('/orders/{order}/address', [OrderController::class, 'addAddress']);
Route::post('/orders/{order}/payment', [OrderController::class, 'addPayment']);
Route::post('/orders/{order}/complete', [OrderController::class, 'complete']);

Route::get('/test', function() {
    return response()->json(['status' => 'working']);
});
