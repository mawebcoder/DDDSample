<?php

namespace Codestoon\Infrastructure\ACL\Elasticsearch\Models;

use Mawebcoder\Elasticsearch\Models\BaseElasticsearchModel;

class EPermission extends BaseElasticsearchModel
{

    public const COLUMN_ID = 'id';
    public const COLUMN_ENGLISH_TITLE = 'english_title';

    public const COLUMN_PERSIAN_TITLE = 'persian_title';

    public const COLUMN_IS_ACTIVE = 'is_active';
    public const COLUMN_ROLES = 'roles';

    public function getIndex(): string
    {
        return 'permissions';
    }
}
