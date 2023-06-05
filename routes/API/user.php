<?php

use Illuminate\Support\Facades\Route;

use Codestoon\Orchestrator\User\UserOrchestrator;

Route::prefix('users')
    ->controller(UserOrchestrator::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/', 'store')->name('user.store');
        Route::put('/{id}', 'update')->name('user.update');
        Route::delete('/{id}', 'delete')->name('user.delete');
    });
