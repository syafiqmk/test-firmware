<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Web\BrandController;
use App\Http\Controllers\Web\FirmwareController;
use App\Http\Controllers\Web\DeviceCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route for GeneralController
Route::controller(GeneralController::class)->group(function() {
    Route::get('/', 'home')->name('home');
});

// Route for Authentication
Route::name('auth.')->controller(AuthController::class)->group(function() {

    // Route for Guest to Login
    Route::middleware('guest')->group(function() {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'attempt')->name('loginAttempt');
    });

    // Route for Authenticated User to Logout
    Route::get('/logout', 'logout')->middleware('auth')->name('logout');

});


Route::middleware('auth')->group(function() {

    // Brand Middleware
    Route::name('brand.')->controller(BrandController::class)->group(function() {
        Route::get('/brand', 'index')->name('index');
        Route::get('/brand/create', 'create')->name('create');
        Route::post('/brand/create', 'store')->name('store');
        Route::get('/brand/edit/{brand}', 'edit')->name('edit');
        Route::put('/brand/edit/{brand}', 'update')->name('update');
        Route::delete('/brand/delete/{brand}', 'destroy')->name('destroy');
    });

    // Device Cateogry Middleware
    Route::name('category.')->controller(DeviceCategoryController::class)->group(function() {
        Route::get('/category', 'index')->name('index');
        Route::get('/category/create', 'create')->name('create');
        Route::post('/category/create', 'store')->name('store');
        Route::get('/category/edit/{deviceCategory}', 'edit')->name('edit');
        Route::put('/category/edit/{deviceCategory}', 'update')->name('update');
        Route::delete('/category/delete/{deviceCategory}', 'destroy')->name('destroy');
    });

    // Firmware Middleware
    Route::name('firmware.')->controller(FirmwareController::class)->group(function() {
        Route::get('/firmware', 'index')->name('index');
        Route::get('/firmware/create', 'create')->name('create');
        Route::post('/firmware/create', 'store')->name('store');
        Route::get('/firmware/edit/{firmware}', 'edit')->name('edit');
        Route::put('/firmware/edit/{firmware}', 'update')->name('update');
        Route::delete('/firmware/delete/{firmware}', 'destroy')->name('destroy');
    });
});
