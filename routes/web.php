<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
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

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::post('/verify', [SubscriptionController::class, 'verify'])->name('users.verify');
Route::get('/verify', [SubscriptionController::class, 'showVerificationForm']);

Route::post('/esewa', [PaymentController::class, 'esewaPay'])->name('esewa');
Route::get('/success', [PaymentController::class, 'esewaPaySuccess']);
Route::get('/failure', [PaymentController::class, 'esewaPayFailed']);
Route::get('/ticket/download/{ticketId}', [PaymentController::class, 'downloadTicket'])->name('ticket.download');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/clubs/create', [ClubController::class, 'create'])->name('clubs.create');
        Route::post('/clubs/create', [ClubController::class, 'store'])->name('clubs.store');
        Route::get('/clubs', [ClubController::class, 'index'])->name('clubs.index');
        Route::get('/club/{id}/edit', [ClubController::class, 'edit'])->name('clubs.edit');
        Route::put('/club/{id}/edit', [ClubController::class, 'update'])->name('clubs.update');
        Route::delete('/club/{id}/delete', [ClubController::class, 'destroy'])->name('clubs.delete');

        // Route::get('/users', [UserController::class, 'userShow'])->name('userShow');
        // Route::get('/user/create', [AuthAdminRegisterController::class, 'showRegistrationForm'])->name('register');
        // Route::post('/user/create', [AuthAdminRegisterController::class, 'clubregister'])->name('clubregister');
        // Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        // Route::put('/user/{id}/edit', [UserController::class, 'update'])->name('users.update');
        // Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('users.delete');

        Route::get('/events/admin', [EventController::class, 'adminIndex'])->name('events.adminIndex');
        Route::get('/events/admin/ticket/{id}', [EventController::class, 'adminTicket'])->name('admin.events.ticket');

        Route::get('/admin/change-password', [UserController::class, 'adminchangePassword'])->name('admin.changePassword');
        Route::post('/admin/change-password', [UserController::class, 'adminchangePasswordSave'])->name('admin.postChangePassword');
        Route::get('/admin/showFinance', [FinanceController::class, 'adminShow'])->name('admin.show_finance');

        Route::get('/admin/contact', [ContactController::class, 'show'])->name('contact.show');
        Route::delete('/contact/{id}/delete', [ContactController::class, 'destroy'])->name('contacts.delete');
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
    Route::get('/events/ticket/{id}', [EventController::class, 'ticket'])->name('events.ticket');

    Route::get('/events/viewcollaborate', [CollaborationController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/collaborate', [CollaborationController::class, 'collaborate'])->name('events.collaborate');
    Route::post('/events/{eventId}/accept/{userId}', [CollaborationController::class, 'acceptCollaboration'])->name('events.acceptCollaboration');
    Route::post('/events/{eventId}/reject/{userId}', [CollaborationController::class, 'rejectCollaboration'])->name('events.rejectCollaboration');

    Route::get('/clubparticipation', [ParticipationController::class, 'clubparticipation'])->name('clubparticipation');

    Route::get('/showFinance', [FinanceController::class, 'showFinance'])->name('events.showFinance');
    Route::get('/clubs/update-budget/{event}', [FinanceController::class, 'updateBudgetShow'])->name('events.update_budgetShow');
    Route::put('/clubs/update-budget/{event}', [FinanceController::class, 'updateBudget'])->name('events.update_budget');
});
