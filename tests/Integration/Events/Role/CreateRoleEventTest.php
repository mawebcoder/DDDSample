<?php

namespace Tests\Integration\Events\Role;

use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\ACL\Events\RoleCreatedEvent;
use Codestoon\Domains\ACL\Events\RoleDeletedEvent;
use Codestoon\Domains\ACL\Events\RoleUpdatedEvent;
use Codestoon\Infrastructure\ACL\Elasticsearch\Models\ERole;
use Codestoon\Infrastructure\ACL\Listeners\DeleteRoleFromElasticsearchListener;
use Codestoon\Infrastructure\ACL\Listeners\SyncRoleWithElasticsearchListener;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use ReflectionException;
use Tests\TestCase;

class CreateRoleEventTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;


    public function test_role_created_event_will_dispatch_while_role_created()
    {
        Event::fake();

        $role = Role::factory()->create();

        Event::assertDispatched(RoleCreatedEvent::class);
    }

    public function test_role_created_event_listeners_implement()
    {
        $event = Event::fake();

        $event->assertListening(RoleCreatedEvent::class, SyncRoleWithElasticsearchListener::class);
    }

    public function test_role_updated_event_will_dispatch_while_role_updated()
    {
        Event::fake();

        $role = Role::factory()->create();

        $role->{Role::COLUMN_PERSIAN_TITLE} = $this->faker->unique()->name;

        $role->save();

        Event::assertDispatched(RoleUpdatedEvent::class);
    }


    public function test_role_updated_event_implement_listeners()
    {
        $event = Event::fake();

        $event->assertListening(RoleUpdatedEvent::class, SyncRoleWithElasticsearchListener::class);
    }

    public function test_role_deleted_event_dispatch()
    {
        Event::fake();

        $role = Role::factory()->create();

        $role->delete();

        Event::assertDispatched(RoleDeletedEvent::class);
    }

    public function test_role_deleted_event_listeners_implemented()
    {
        $event = Event::fake();

        $event->assertListening(RoleDeletedEvent::class, DeleteRoleFromElasticsearchListener::class);
    }
}
