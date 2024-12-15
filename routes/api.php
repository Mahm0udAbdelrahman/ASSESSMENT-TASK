<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('task')->controller(TaskController::class)->group(function () {
    Route::get('/',  'index');
    Route::post('/',  'store');
    Route::get('/{id}',  'show');
    Route::post('/{id}',  'update');
    Route::delete('delete/{id}',  'destroy');
    Route::post('restore/{id}',  'restore');
    Route::delete('forceDelete/{id}',  'forceDelete');
});
