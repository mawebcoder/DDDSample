<?php

use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\BaseModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Codestoon\Domains\User\Entities\User;

return new class extends Migration {


    public function up(): void
    {
        Schema::create((new User())->getTable(), function (Blueprint $table) {
            $table->string(User::COLUMN_FIRST_NAME)->nullable();
            $table->string(User::COLUMN_LAST_NAME)->nullable();
            $table->string(User::COLUMN_EMAIL)->unique();
            $table->string(User::COLUMN_PHONE_NUMBER)->unique()->nullable();
            $table->integer(User::COLUMN_EMAIL_VERIFICATION_CODE)->nullable();
            $table->integer(User::COLUMN_PHONE_VERIFICATION_CODE)->nullable();
            $table->timestamp(User::COLUMN_EMAIL_VERIFICATION_CODE_EXPIRES_AT)->nullable();
            $table->timestamp(User::COLUMN_PHONE_VERIFICATION_CODE_EXPIRES_AT)->nullable();
            $table->timestamp(User::COLUMN_PHONE_VERIFIED_AT)->nullable();
            $table->timestamp(User::COLUMN_EMAIL_VERIFIED_AT)->nullable();
            $table->timestamp(User::COLUMN_VIP_PLAN_EXPIRES_AT)->nullable();
            $table->boolean(User::COLUMN_IS_ACTIVE)->default(false);
            $table->foreignId(User::COLUMN_ROLE_ID)
                ->nullable()
                ->references(BaseModel::COLUMN_ID)
                ->on((new Role())->getTable())
                ->nullOnDelete();
            $table->string(User::COLUMN_PASSWORD);
            $table->string(User::COLUMN_TEMPORARY_PASSWORD)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new User())->getTable());
    }
};
