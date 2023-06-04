<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Codestoon\Domains\ACL\Entities\Permission;
use Codestoon\Domains\ACL\Entities\Role;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->foreignId('permission_id')->references('id')->on((new Permission())->getTable())->cascadeOnDelete();
            $table->foreignId('role_id')->references('id')->on((new Role())->getTable())->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_role');
    }
};
