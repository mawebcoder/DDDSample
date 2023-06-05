<?php

namespace Codestoon\Infrastructure\ACL\Listeners;

use Codestoon\Domains\ACL\Entities\Permission;
use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\ACL\Events\RoleCreatedEvent;
use Codestoon\Domains\User\Entities\User;
use Codestoon\Infrastructure\ACL\Elasticsearch\Models\ERole;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Mawebcoder\Elasticsearch\Exceptions\FieldNotDefinedInIndexException;
use ReflectionException;

class SyncRoleWithElasticsearchListener
{


    public function handle(RoleCreatedEvent $roleCreatedEvent): void
    {

    }


}
