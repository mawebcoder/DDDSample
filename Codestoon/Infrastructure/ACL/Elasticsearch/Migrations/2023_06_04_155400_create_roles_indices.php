<?php

use Mawebcoder\Elasticsearch\Migration\BaseElasticMigration;
use Codestoon\Infrastructure\ACL\Elasticsearch\Models\ERole;

return new class extends BaseElasticMigration {

    public function getModel(): string
    {
        return ERole::class;
    }

    public function schema(BaseElasticMigration $mapper): void
    {
        $mapper->bigInteger('id');
        $mapper->boolean('is_active');
        $mapper->string('persian_title');
        $mapper->string('english_title');
        $mapper->object('users', [
            'id' => self::TYPE_BIGINT,
            'full_name' => self::TYPE_STRING,
            'email' => self::TYPE_STRING,
            'phone' => self::TYPE_STRING
        ]);
        $mapper->object('permissions', [
            'id' => self::TYPE_BIGINT,
            'persian_title' => self::TYPE_STRING,
            'english_title' => self::TYPE_STRING,
            'is_active' => self::TYPE_BOOLEAN
        ]);
    }
};
