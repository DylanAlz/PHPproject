<?php

use App\Http\Controllers\AcoountController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AcoountController::class, 'login'])
        ->name('login');

    Route::post('login', [AcoountController::class, 'loginPost']);

    Route::get('/forgot-password', [AcoountController::class, 'forgotPassword'])
        ->name('forgotPassword');
    
    Route::post('/recovery-password', [AcoountController::class, 'recoveryPassword'])
        ->name('recoveryPassword');

    Route::get('/reset-password{token}', [AcoountController::class, 'resetPassword'])
        ->name('password.reset');
    
    Route::post('/reset-password', [AcoountController::class, 'resetPasswordPost'])
        ->name('password.update');

});

Route::middleware('auth')->group(function () {
 
    Route::post('logout', [AcoountController::class, 'logout'])
        ->name('logout');

    Route::get('/profile/edit', [AcoountController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile/update', [AcoountController::class, 'update'])
        ->name('profile.update');

    Route::get('/profile/change-password', [AcoountController::class, 'changePassword'])
        ->name('profile.changePassword');
    
    Route::patch('/profile/update-password', [AcoountController::class, 'updatePassword'])
        ->name('profile.updatePassword');
});



