<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin')
    ->name('admin.')
    ->middleware('auth:sanctum')
    ->group(base_path('routes/v1/admin.php'));

Route::prefix('/auth')
    ->name('auth.')
    ->group(base_path('routes/v1/auth.php'));

Route::prefix('/profile')
    ->name('profile.')
    ->middleware('auth:sanctum')
    ->group(base_path('routes/v1/profile.php'));

Route::prefix('/public')
    ->name('public.')
    ->middleware('auth:sanctum')
    ->group(base_path('routes/v1/public.php'));
