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


    /**
     * @throws FieldNotDefinedInIndexException
     * @throws RequestException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function handle(RoleCreatedEvent $roleCreatedEvent): void
    {
        $role = $roleCreatedEvent->role;

        $permissions = $role->permissions;

        $users = $role->users;

        $eRole = new ERole();

        $eRole->id = $role->id;

        $eRole->{ERole::COLUMN_PERSIAN_TITLE} = $role->{Role::COLUMN_PERSIAN_TITLE};

        $eRole->{ERole::COLUMN_IS_ACTIVE} = $role->{Role::COLUMN_IS_ACTIVE};

        $eRole->{ERole::COLUMN_ENGLISH_TITLE} = $role->{Role::COLUMN_ENGLISH_TITLE};

        $eRole->{ERole::COLUMN_PERMISSIONS} = $this->getPermissions($permissions);

        $users = $this->getUsers($users);


        $eRole->save();
    }

    public function getPermissions(Collection $collection): array
    {
        $permissions = [];

        $collection->each(function (Permission $permission) use (&$permissions) {
            $permissions[] = [
                'id' => $permission->id,
                'persian_title' => $permission->{Permission::COLUMN_PERSIAN_TITLE},
                'english_title' => $permission->{Permission::COLUMN_ENGLISH_TITLE},
                'is_active' => $permission->{Permission::COLUMN_IS_ACTIVE}
            ];
        });

        return $permissions;
    }

    private function getUsers(Collection $collection)
    {
        $users = [];

        $collection->each(function (User $user) use (&$users) {
            $users[] = [
                'id' => $user->id,
//                'full_name' => $user->,
                'phone' => '',
                'email' => '',
            ];
        });
    }
}
