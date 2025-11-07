<?php

use Illuminate\Support\Facades\Route;
use OrderManagement\Public\Presentation\Controllers\V1\IndexProductController;
use OrderManagement\Public\Presentation\Controllers\V1\ShowProductController;

Route::prefix('/products')
    ->name('products.')
    ->group(function () {
        Route::get('/', IndexProductController::class)
            ->name('index');

        Route::get('/{product}', ShowProductController::class)
            ->name('show');
    });
