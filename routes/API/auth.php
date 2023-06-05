<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->group(function () {
        /**
         * admin
         */
        Route::prefix('admin')
            ->controller()
            ->group(function () {
                Route::post('/login', 'login')->name('admin.login');
            });
        /**
         * client
         */
    });
