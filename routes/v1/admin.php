<?php

use Illuminate\Support\Facades\Route;
use OrderManagement\Admin\Presentation\Controllers\V1\ChangeOrderStatusController;
use OrderManagement\Admin\Presentation\Controllers\V1\CreateProductController;
use OrderManagement\Admin\Presentation\Controllers\V1\UpdateProductController;

Route::prefix('/orders')
    ->name('orders.')
    ->group(function () {
        Route::post('/{order}/change-status', ChangeOrderStatusController::class)
            ->name('change-status');
    });

Route::prefix('/products')
    ->name('products.')
    ->group(function () {
        Route::post('/create', CreateProductController::class)
            ->name('store');

        Route::post('/update/{product}', UpdateProductController::class)
            ->name('update');
    });
