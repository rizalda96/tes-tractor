<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app');
});

Route::group(['prefix' => 'trip', 'as' => 'trip.'], function () {
    Route::get('/', [TripController::class, 'search'])->name('get');
    Route::post('/store', [TripController::class, 'store'])->name('store');
    Route::put('/update', [TripController::class, 'update'])->name('update');
    Route::get('/{id}/detail', [TripController::class, 'show'])->name('show');
    Route::delete('/drop', [TripController::class, 'drop'])->name('drop');
});

Route::group(['prefix' => 'driver', 'as' => 'driver.'], function () {
    Route::get('/', [DriverController::class, 'search'])->name('get');
    Route::post('/store', [DriverController::class, 'store'])->name('store');
    Route::put('/update', [DriverController::class, 'update'])->name('update');
    Route::get('/{id}/detail', [DriverController::class, 'show'])->name('show');
    Route::delete('/drop', [DriverController::class, 'drop'])->name('drop');
});

Route::group(['prefix' => 'vehicle', 'as' => 'vehicle.'], function () {
    Route::get('/', [VehicleController::class, 'search'])->name('get');
    Route::post('/store', [VehicleController::class, 'store'])->name('store');
    Route::put('/update', [VehicleController::class, 'update'])->name('update');
    Route::get('/{id}/detail', [VehicleController::class, 'show'])->name('show');
    Route::delete('/drop', [VehicleController::class, 'drop'])->name('drop');
});
