<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Codestoon\Domains\ACL\Entities\Role;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {


    public function up()
    {
        Schema::create((new Role())->getTable(), function (Blueprint $table) {
            $table->string(Role::COLUMN_PERSIAN_TITLE)->unique();
            $table->string(Role::COLUMN_ENGLISH_TITLE)->unique();
            $table->boolean(Role::COLUMN_IS_ACTIVE)->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Role())->getTable());
    }

};
