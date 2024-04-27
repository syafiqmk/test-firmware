<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;

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
