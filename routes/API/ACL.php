<?php

use Codestoon\Orchestrator\ACL\RoleOrchestrator;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')
    ->controller(RoleOrchestrator::class)
    ->group(function () {
        Route::post('/', 'store')->name('role.store');
        Route::put('/{id}', 'update')->name('role.update');
        Route::delete('/{id}', 'delete')->name('role.delete');
    });
