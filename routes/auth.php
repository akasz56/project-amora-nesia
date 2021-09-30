<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::middleware(['guest'])->group(function () {
    Route::get('register', function () {
        
        return view('auth.register');
    })->name('register');

    Route::post('register', [AuthController::class, 'register'])
        ->name('register.post');

    Route::view('login', 'auth.login')
        ->name('login');
    Route::post('login', [AuthController::class, 'login'])
        ->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])
        ->name('logout');
});

Route::middleware('auth')
    ->name('verification.')
    ->group(function () {
        Route::get('/email/verify', function () {
            return view('auth.verify-email');
        })
            ->name('notice');

        Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
            return redirect('/home');
        })->middleware('signed')
            ->name('verify');

        Route::post('/email/verification-notification', function (Request $request) {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('message', 'Verification link sent!');
        })->middleware('throttle:6,1')
            ->name('send');
    });
