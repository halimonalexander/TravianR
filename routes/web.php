<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'guest'], static function () {
    Route::get('/', [GuestController::class, 'showIndexPage'])->name('indexPage');
    Route::get('/login', [GuestController::class, 'showLoginPage'])->name('loginPage');
    Route::post('/login', [GuestController::class, 'login'])->name('login');
    Route::get('/registration', [GuestController::class, 'showRegistrationPage'])->name('registrationPage');
    Route::post('/registration', [GuestController::class, 'registration']);
    Route::get('/activation', [GuestController::class, 'activationPage'])->name('activationPage');
    Route::post('/activation', [GuestController::class, 'activation']);
});

Route::group(['middleware' => 'auth'], static function () {
    Route::get('/main', [MainController::class, 'showMainPage'])->name('mainPage');
    Route::get('/logout', [MainController::class, 'logout'])->name('logout');
});
