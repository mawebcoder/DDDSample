<?php

namespace Codestoon\Infrastructure\ACL\Elasticsearch\Models;

use Mawebcoder\Elasticsearch\Models\BaseElasticsearchModel;

class ERole extends BaseElasticsearchModel
{

    const COLUMN_FILED_ID = 'id';
    const COLUMN_IS_ACTIVE = 'is_active';
    const COLUMN_PERSIAN_TITLE = 'persian_title';
    const COLUMN_ENGLISH_TITLE = 'english_title';
    const COLUMN_USERS = 'users';
    const COLUMN_PERMISSIONS = 'permissions';

    public function getIndex(): string
    {
        return 'roles';
    }
}
