<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Codestoon\Domains\ACL\Entities\Permission;

return new class extends Migration {

    public function up(): void
    {
        Schema::create((new Permission())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string(Permission::COLUMN_PERSIAN_TITLE)->unique();
            $table->string(Permission::COLUMN_ENGLISH_TITLE)->unique();
            $table->boolean(Permission::COLUMN_IS_ACTIVE)->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Permission())->getTable());
    }

};
