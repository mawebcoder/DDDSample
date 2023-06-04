<?php

use Codestoon\Orchestrator\ACL\RoleOrchestrator;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')
    ->controller(RoleOrchestrator::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/', 'store')->name('role.store');
    });
