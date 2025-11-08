<?php

use Illuminate\Support\Facades\Route;
use OrderManagement\Profile\Presentation\Controllers\V1\CreateOrderController;
use OrderManagement\Profile\Presentation\Controllers\V1\IndexOrderController;
use OrderManagement\Profile\Presentation\Controllers\V1\ShowOrderController;

Route::prefix('/orders')
    ->name('orders.')
    ->group(function () {
        Route::post('/', CreateOrderController::class)
            ->name('store');

        Route::get('/', IndexOrderController::class)
            ->name('index');

        Route::get('/{order}', ShowOrderController::class)
            ->name('show');
    });
