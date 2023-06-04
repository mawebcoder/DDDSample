<?php

namespace Codestoon\Infrastructure\ACL\Elasticsearch\Models;

use Mawebcoder\Elasticsearch\Models\BaseElasticsearchModel;

class ERole extends BaseElasticsearchModel
{

    public function getIndex(): string
    {
        return 'roles';
    }
}
