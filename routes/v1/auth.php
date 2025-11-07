<?php

use Illuminate\Support\Facades\Route;
use OrderManagement\Auth\Presentation\Controllers\V1\UserAuthorizationController;
use OrderManagement\Auth\Presentation\Controllers\V1\UserRegistrationController;

Route::post('/registration', UserRegistrationController::class)
    ->name('registration');

Route::post('/authorization', UserAuthorizationController::class)
    ->name('authorization');
