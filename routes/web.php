<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminRegisterController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('home', 'home')->name('home');
});

Route::get('/register', [AuthAdminRegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthAdminRegisterController::class, 'clubregister'])->name('clubregister');