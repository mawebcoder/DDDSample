<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Codestoon\Domains\User\Entities\User;
use Codestoon\Domains\ACL\Entities\Role;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create((new User())->getTable(),function (Blueprint $table){

        });
    }

    public function down():void
    {
        Schema::dropIfExists((new User())->getTable());
    }
};
