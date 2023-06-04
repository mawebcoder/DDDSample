<?php

namespace Codestoon\Domains\User\ValueObjects;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

readonly class UserValueObject
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $emailVerificationCode;
    private string $phoneVerificationCode;
    private string $phoneNumber;
    private string $phoneVerificationCodeExpiresAt;
    private string $emailVerificationCodeExpiresAt;
    private string $emailVerifiedAt;
    private string $phoneVerifiedAt;
    private string $vipPlanExpiresAt;
    private bool $isActive;
    private int $roleId;

    private string $password;
    private string $temporaryPassword;

    public function setFirstName(?string $firstName): static
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setEmailVerificationCode(?string $code): static
    {
        $this->emailVerificationCode = $code;
        return $this;
    }

    public function getEmailVerificationCode(): ?string
    {
        return $this->emailVerificationCode;
    }

    public function setEmailVerificationCodeExpiresAt(?Carbon $carbon): static
    {
        $this->emailVerificationCodeExpiresAt = $carbon?->format('Y-m-d H:i:s');
        return  $this;
    }

    public function getEmailVerificationExpiresAt(): ?string
    {
        return $this->emailVerificationCodeExpiresAt;
    }

    public function setPhoneVerificationCode(?string $code): static
    {
        $this->phoneVerificationCode = $code;
        return $this;
    }

    public function getPhoneVerificationCode(): ?string
    {
        return $this->phoneVerificationCode;
    }

    public function setPhoneVerificationCodeExpiresAt(?Carbon $carbon): static
    {
        $this->phoneVerificationCodeExpiresAt = $carbon?->format('Y-m-d H:i:s');
        return $this;
    }

    public function getPhoneVerificationCodeExpiresAt(): ?string
    {
        return $this->phoneVerificationCodeExpiresAt;
    }

    public function setEmailVerifiedAt(Carbon $carbon): static
    {
        $this->emailVerifiedAt = $carbon->format('Y-m-d H:i:s');
        return $this;
    }

    public function getEmailVerifiedAt(): ?string
    {
        return $this->emailVerifiedAt;
    }

    public function setPhoneVerifiedAt(Carbon $carbon): static
    {
        $this->phoneVerifiedAt = $carbon->format('Y-m-d H:i:s');
        return $this;
    }

    public function getPhoneVerifiedAt(): ?string
    {
        return $this->phoneVerifiedAt;
    }

    public function setVipExpiresAt(Carbon $carbon): static
    {
        $this->vipPlanExpiresAt = $carbon->format('Y-m-d H:i:s');
        return $this;
    }

    public function getVipExpiresAt(): ?string
    {
        return $this->vipPlanExpiresAt;
    }

    public function setIsActive(bool $value): static
    {
        $this->isActive = intval($value);
        return $this;
    }

    public function getIsActive(): bool
    {
        return boolval($this->isActive);
    }

    public function setRoleId(int $roleId): static
    {
        $this->roleId = $roleId;
        return $this;
    }

    public function getRoleId(): ?string
    {
        return $this->roleId;
    }

    public function setPassword(string $password): static
    {
        $this->password = Hash::make($password);
        return $this;
    }

    public function setTemporaryPassword(string $temporaryPassword): static
    {
        $this->temporaryPassword = Hash::make($temporaryPassword);
        return $this;
    }
}
