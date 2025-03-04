<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\LabelController;
use App\Http\Controllers\Api\CategoryController;


Route::post('/login', [AuthenticatedSessionController::class, 'store']);
// Route::post('/logout', function (Request $request) {
//     $request->user()->currentAccessToken()->delete();
//     return response()->json(['message' => 'Logged out']);
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('task', TaskController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('label', LabelController::class);
    Route::post('/logout', function (Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    });
});


