<?php

namespace Database\Seeders;

use Codestoon\Domains\ACL\Entities\Permission;
use Codestoon\Domains\ACL\Enums\PermissionsEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = PermissionsEnum::toArray();

        foreach ($permissions as $englishTitle => $persianTitle) {
            Permission::query()->updateOrCreate([
                Permission::COLUMN_ENGLISH_TITLE => $englishTitle,
                Permission::COLUMN_PERSIAN_TITLE => $persianTitle,
            ], [
                Permission::COLUMN_IS_ACTIVE => 1
            ]);
        }
    }
}
