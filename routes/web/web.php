<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    \Codestoon\Domains\ACL\Entities\Role::factory()->create();

});
