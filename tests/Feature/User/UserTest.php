<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;

class UserTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    public function test_can_register_an_user()
    {

    }

    public function test_can_update_an_user()
    {

    }

    public function test_can_delete_an_user()
    {

    }

    public function test_can_force_delete_an_user()
    {

    }

    public function test_can_restore_an_user()
    {

    }

    public function test_users_list()
    {

    }

    public function test_update_user_validation()
    {

    }

    public function test_register_user_validation()
    {

    }
}
