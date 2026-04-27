<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\MaintenanceController;
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
    ->middleware(['auth'])
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

Route::resource('suppliers', SupplierController::class)->only([
    'index', 'store', 'destroy'
]);

Route::resource('stocks', StockController::class)->only([
    'index', 'create', 'store'
]);

Route::resource('sales', SalesController::class)->only([
    'index', 'create', 'store'
]);

Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');

Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');

Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

Route::get('/maintenances', [MaintenanceController::class, 'index'])->name('maintenances.index');

Route::post('/maintenances', [MaintenanceController::class, 'store'])->name('maintenances.store');

Route::get('/maintenances/{id}/edit', [MaintenanceController::class, 'edit'])->name('maintenances.edit');

Route::put('/maintenances/{id}', [MaintenanceController::class, 'update'])->name('maintenances.update');