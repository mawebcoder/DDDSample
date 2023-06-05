<?php

namespace Codestoon\Infrastructure\File\Factories;

use Codestoon\Domains\File\Entities\File;
use Codestoon\Domains\File\Enums\FilePrivacyEnum;
use Codestoon\Domains\File\Enums\FileTypeEnum;
use Codestoon\Domains\User\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class FileFactory extends Factory
{
    protected $model = File::class;

    public function definition(): array
    {
        return [
            File::COLUMN_DIRECTORY => $this->faker->filePath(),
            File::COLUMN_EXTENSION => $this->faker->fileExtension(),
            File::COLUMN_FILE_NAME => function ($attributes) {
                return $this->faker->name . '.' . $attributes[File::COLUMN_EXTENSION];
            },
            File::COLUMN_SIZE => $this->faker->numberBetween(1000, 2000),
            File::COLUMN_FILEABLE_ID => User::factory(),
            File::COLUMN_FILEABLE_TYPE => User::class,
            File::COLUMN_BUCKET => $this->faker->name,
            File::COLUMN_DISK => $this->faker->name,
            File::COLUMN_MIME_TYPE => $this->faker->mimeType(),
            File::COLUMN_FILE_TYPE => Arr::random(array_values(FileTypeEnum::toArray())),
            File::COLUMN_PRIVACY => Arr::random(array_values(FilePrivacyEnum::toArray()))
        ];
    }
}
