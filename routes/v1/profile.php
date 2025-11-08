<?php

use Illuminate\Support\Facades\Route;
use OrderManagement\Profile\Presentation\Controllers\V1\CreateOrderController;

Route::prefix('/orders')
    ->name('orders.')
    ->group(function () {
        Route::post('/', CreateOrderController::class)
            ->name('store');
    });
