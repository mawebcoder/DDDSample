<?php

namespace Codestoon\Infrastructure\ACL\Listeners;

use Codestoon\Domains\ACL\Events\RoleDeletedEvent;
use Codestoon\Domains\BaseModel;
use Codestoon\Infrastructure\ACL\Elasticsearch\Models\ERole;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Client\RequestException;
use ReflectionException;
use Throwable;

class DeleteRoleFromElasticsearchListener
{

    /**
     * @throws Throwable
     * @throws ReflectionException
     * @throws RequestException
     * @throws GuzzleException
     */
    public function handle(RoleDeletedEvent $roleDeletedEvent): void
    {
        ERole::newQuery()->find($roleDeletedEvent->role->{BaseModel::COLUMN_ID})?->delete();
    }
}
