<?php

use App\Http\Controllers\AuthAdminRegisterController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
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

Route::get('/contact', [ContactController::class, 'create'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe.store');
Route::get('/', [HomeController::class, 'userhome'])->name('home');
Route::get('/club', [ClubController::class, 'userclub'])->name('clubs.userclub');
Route::view('/about', 'users.aboutus')->name('aboutus');
Route::get('/events/users', [EventController::class, 'userevent'])->name('userevent');
Route::get('/events/users/{id}', [EventController::class, 'showuser'])->name('event.showuser');
Route::get('/events/search', [EventController::class, 'search'])->name('events.search');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/clubs/create', [ClubController::class, 'create'])->name('clubs.create');
        Route::post('/clubs/create', [ClubController::class, 'store'])->name('clubs.store');
        Route::get('/clubs', [ClubController::class, 'index'])->name('clubs.index');
        Route::get('/club/{id}/edit', [ClubController::class, 'edit'])->name('clubs.edit');
        Route::put('/club/{id}/edit', [ClubController::class, 'update'])->name('clubs.update');
        Route::delete('/club/{id}/delete', [ClubController::class, 'destroy'])->name('clubs.delete');

        Route::get('/users', [UserController::class, 'userShow'])->name('userShow');
        Route::get('/user/create', [AuthAdminRegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/user/create', [AuthAdminRegisterController::class, 'clubregister'])->name('clubregister');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/user/{id}/edit', [UserController::class, 'update'])->name('users.update');
        Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('users.delete');

        Route::get('/events/admin', [EventController::class, 'adminIndex'])->name('events.adminIndex');
    });

    Route::get('/logout', [LogoutController::class, 'logout'])->name('custom.logout');
    Route::get('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('/change-password', [UserController::class, 'changePasswordSave'])->name('postChangePassword');

    Route::get('/myevents', [EventController::class, 'index'])->name('events.index');
    Route::get('/events', [EventController::class, 'all'])->name('events.all');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events/create', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}/edit', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('events/{id}/report/edit', [EventController::class, 'editReport'])->name('events.report.edit');
    Route::put('events/{id}/report', [EventController::class, 'updateReport'])->name('events.report.update');
    Route::post('/events/{event}/collaborate', [EventController::class, 'collaborate'])->name('events.collaborate');
    Route::get('/events/viewcollaborate',[EventController::class,'show'])->name('events.show');
    Route::post('/events/{eventId}/accept/{userId}', [EventController::class, 'acceptCollaboration'])->name('events.acceptCollaboration');
    Route::post('/events/{eventId}/reject/{userId}', [EventController::class, 'rejectCollaboration'])->name('events.rejectCollaboration');

    Route::get('/showFinance', [EventController::class, 'showFinance'])->name('events.showFinance');
    Route::get('/clubs/update-budget/{event}', [EventController::class, 'updateBudgetShow'])->name('events.update_budgetShow');
    Route::put('/clubs/update-budget/{event}', [EventController::class, 'updateBudget'])->name('events.update_budget');
});
