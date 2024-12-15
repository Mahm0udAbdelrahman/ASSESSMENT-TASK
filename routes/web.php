<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('admin.layouts.app');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::resource('category' , CategoryController::class);

//This is better than route resource, because if there is a permission, I give each route its own permission
Route::prefix('category')->as('category.')->controller(CategoryController::class)->group(function () {
    Route::get('/index',  'index')->name('index');
    Route::get('/create',  'create')->name('create');
    Route::post('/store',  'store')->name('store');
    Route::get('show/{id}',  'show')->name('show');
    Route::get('edit/{id}',  'edit')->name('edit');
    Route::put('update/{id}',  'update')->name('update');
    Route::delete('delete/{id}',  'destroy')->name('destroy');
});


Route::prefix('task')->as('task.')->controller(TaskController::class)->group(function () {
    Route::get('/index',  'index')->name('index');
    Route::get('/create',  'create')->name('create');
    Route::post('/store',  'store')->name('store');
    Route::get('show/{id}',  'show')->name('show');
    Route::get('edit/{id}',  'edit')->name('edit');
    Route::put('update/{id}',  'update')->name('update');
    Route::delete('delete/{id}',  'destroy')->name('destroy');
    Route::post('restore/{id}',  'restore')->name('restore');
    Route::delete('forceDelete/{id}',  'forceDelete')->name('forceDelete');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
