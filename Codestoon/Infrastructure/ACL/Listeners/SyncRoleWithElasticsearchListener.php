<?php

namespace Codestoon\Infrastructure\ACL\Listeners;

use Codestoon\Domains\ACL\Entities\Permission;
use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\ACL\Events\RoleCreatedEvent;
use Codestoon\Domains\BaseModel;
use Codestoon\Domains\User\Entities\User;
use Codestoon\Infrastructure\ACL\Elasticsearch\Models\ERole;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Mawebcoder\Elasticsearch\Exceptions\FieldNotDefinedInIndexException;
use ReflectionException;

class SyncRoleWithElasticsearchListener
{


    /**
     * @throws FieldNotDefinedInIndexException
     * @throws RequestException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function handle(RoleCreatedEvent $roleCreatedEvent): void
    {
        $query = ERole::newQuery();

        $query->{ERole::COLUMN_PERSIAN_TITLE} = $roleCreatedEvent->role->{Role::COLUMN_PERSIAN_TITLE};

        $query->{ERole::COLUMN_FILED_ID} = $roleCreatedEvent->role->id;

        $query->{ERole::COLUMN_ENGLISH_TITLE} = $roleCreatedEvent->role->{Role::COLUMN_ENGLISH_TITLE};

        $query->{ERole::COLUMN_IS_ACTIVE} = boolval($roleCreatedEvent->role->{User::COLUMN_IS_ACTIVE});

        $query->{ERole::COLUMN_USERS} = $this->getUsers($roleCreatedEvent->role);

        $query->{ERole::COLUMN_PERMISSIONS} = $this->getPermissions($roleCreatedEvent->role);

        $query->save();
    }

    private function getUsers(Role $role): array
    {
        $users = $role->users()->get();

        $result = [];

        foreach ($users as $user) {
            $result[] = [
                'id' => $user->{User::COLUMN_ID},
                'full_name' => $user->{User::COLUMN_FIRST_NAME} . ' ' . $user->{User::COLUMN_LAST_NAME},
                'email' => $user->{User::COLUMN_EMAIL},
                'phone' => $user->{User::COLUMN_PHONE_NUMBER},
            ];
        }

        return $result;
    }

    private function getPermissions(Role $role): array
    {
        $permissions = $role->permissions()->get();

        $result = [];

        foreach ($permissions as $permission) {
            $result[] = [
                'id' => $permission->{BaseModel::COLUMN_ID},
                'persian_title' => $permission->{Permission::COLUMN_PERSIAN_TITLE},
                'english_title' => $permission->{Permission::COLUMN_ENGLISH_TITLE},
                'is_active' => boolval($permission->{Permission::COLUMN_IS_ACTIVE})
            ];
        }

        return $result;
    }


}
