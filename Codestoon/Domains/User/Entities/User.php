<?php

namespace Codestoon\Domains\User\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $hidden = [
        'password',
        'temporary_password'
    ];

    public const COLUMN_ID = 'id';
    public const COLUMN_FIRST_NAME = 'first_name';
    public const COLUMN_LAST_NAME = 'last_name';
    public const COLUMN_EMAIL = 'email';
    public const COLUMN_PHONE_NUMBER = 'phone_number';
    public const COLUMN_EMAIL_VERIFICATION_CODE = 'email_verification_code';
    public const COLUMN_EMAIL_VERIFICATION_CODE_EXPIRES_AT = 'email_verification_code_expires_at';
    public const COLUMN_PHONE_VERIFICATION_CODE = 'phone_verification_code';
    public const COLUMN_PHONE_VERIFICATION_CODE_EXPIRES_AT = 'phone_verification_code_expires_at';
    public const COLUMN_EMAIL_VERIFIED_AT = 'email_verified_at';
    public const COLUMN_PHONE_VERIFIED_AT = 'phone_verified_at';
    public const COLUMN_VIP_PLAN_EXPIRES_AT = 'vip_plan_expires_at';
    public const COLUMN_IS_ACTIVE = 'is_active';
    public const COLUMN_ROLE_ID = 'role_id';
    public const COLUMN_PASSWORD = 'password';
    public const COLUMN_TEMPORARY_PASSWORD = 'temporary_password';

}
