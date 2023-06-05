<?php

use Mawebcoder\Elasticsearch\Migration\BaseElasticMigration;
use Codestoon\Infrastructure\ACL\Elasticsearch\Models\EPermission;

return new class extends BaseElasticMigration {

    public function getModel(): string
    {
        return EPermission::class;
    }

    public function schema(BaseElasticMigration $mapper):void
    {
        $mapper->bigInteger(EPermission::COLUMN_ID);
        $mapper->string(EPermission::COLUMN_PERSIAN_TITLE);
        $mapper->string(EPermission::COLUMN_ENGLISH_TITLE);
        $mapper->boolean(EPermission::COLUMN_IS_ACTIVE);
        $mapper->object(EPermission::COLUMN_ROLES, [
            'id' => self::TYPE_BIGINT,
            'persian_title' => self::TYPE_STRING,
            'english_title' => self::TYPE_STRING,
            'is_active' => self::TYPE_BOOLEAN,
        ]);
    }
};
