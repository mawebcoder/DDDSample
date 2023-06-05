<?php

namespace Tests\Feature\Auth;

use Codestoon\Domains\BaseModel;
use Codestoon\Domains\User\Entities\User;

use Codestoon\Infrastructure\User\Notifications\EmailVerificationCodeNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }


    public function test_can_get_verification_code_while_login_to_admin_panel()
    {
        Notification::fake();

        $password = $this->faker->password;

        $user = User::factory()->state([
            User::COLUMN_PASSWORD => bcrypt($password),
            User::COLUMN_EMAIL => $this->faker->email
        ]);

        $response = $this->postJson(route('admin.login'), [
            'email' => $user->{User::COLUMN_EMAIL},
            'password' => $password
        ]);

        $response->assertOk();

        $user = User::getById($user->{BaseModel::COLUMN_ID});

        Notification::assertSentTo(
            $user,
            fn(EmailVerificationCodeNotification $emailVerificationCodeNotification
            ) => $emailVerificationCodeNotification->code == $user->{User::COLUMN_EMAIL_VERIFICATION_CODE}
        );
    }



    public function test_can_not_get_verification_code_while_login_to_admin_panel_with_incorrect_credential()
    {
    }

    public function test_can_get_token_if_code_is_valid()
    {
    }

    public function test_can_not_get_token_if_code_is_not_valid()
    {
    }

    public function test_can_resend_verification_code()
    {
    }

    public function test_can_not_resend_verification_code_if_user_has_active_code()
    {
    }

    public function test_user_can_not_access_verification_api_if_temp_password_is_not_valid()
    {
    }
}
