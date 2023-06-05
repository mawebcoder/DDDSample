<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Codestoon\Domains\File\Entities\File;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {

    public function up(): void
    {
        Schema::create((new File())->getTable(), function (Blueprint $table) {
            $table->unsignedBigInteger(File::COLUMN_FILEABLE_ID);
            $table->string(File::COLUMN_FILE_TYPE);
            $table->string(File::COLUMN_MIME_TYPE);
            $table->string(File::COLUMN_FILEABLE_TYPE);
            $table->string(File::COLUMN_DISK);
            $table->string(File::COLUMN_BUCKET);
            $table->string(File::COLUMN_DIRECTORY);
            $table->string(File::COLUMN_EXTENSION);
            $table->tinyInteger(File::COLUMN_PRIVACY);
            $table->tinyInteger(File::COLUMN_FILE_NAME);
            $table->integer(File::COLUMN_SIZE);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new File())->getTable());
    }
};
