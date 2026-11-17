<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\{AuthenticatedSessionController, EmailVerificationController, NewPasswordController, PasswordResetLinkController, RegisteredParentController, TemporaryPasswordController};
use App\Http\Controllers\{ChallengeAttemptController, DashboardController, LessonController, LessonMediaController};

Route::get('/', [DashboardController::class, 'redirect'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:login')
        ->name('login.store');

    Route::get('/parent/register', [RegisteredParentController::class, 'create'])->name('parent.register');
    Route::post('/parent/register', [RegisteredParentController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('parent.register.store');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('password.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->middleware('role:parent')
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['role:parent', 'signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware(['role:parent', 'throttle:6,1'])
        ->name('verification.send');

    Route::get('/password/change', [TemporaryPasswordController::class, 'edit'])
        ->middleware('role:child')
        ->name('password.change');
    Route::put('/password/change', [TemporaryPasswordController::class, 'update'])
        ->middleware(['role:child', 'throttle:5,1'])
        ->name('password.change.update');

    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'admin'])->name('dashboard');
    });

    Route::prefix('parent')->name('parent.')->middleware(['role:parent', 'verified'])->group(function () {
        Route::get('/', [DashboardController::class, 'parent'])->name('dashboard');
        Route::get('/children/{child}', [DashboardController::class, 'child'])->name('children.show');
    });

    Route::prefix('learn')->name('learn.')->middleware([
        'role:child,admin',
        'password.change',
    ])->group(function () {
        Route::get('/', [DashboardController::class, 'learn'])
            ->middleware('role:child')
            ->name('dashboard');
        Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
        Route::post('/challenges/{challenge}/attempts', [ChallengeAttemptController::class, 'store'])
            ->middleware(['role:child', 'throttle:20,1'])
            ->name('challenges.attempts.store');
    });

    Route::get('/media/{media}', [LessonMediaController::class, 'show'])
        ->middleware(['role:child,admin', 'password.change'])
        ->name('media.show');
});

Route::view('cms.parent', 'cms.parent')->name('cms.parent');
Route::view('cms.parent2', 'cms.parent2')->name('cms.parent2');
Route::view('/cms/dashboard', 'cms.dashboard')->name('cms.dashboard');