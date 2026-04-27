<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| EMPLOYEE ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/employees', [EmployeeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('employees.index');

Route::get('/employees/{id}', [EmployeeController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('employees.show');

/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';