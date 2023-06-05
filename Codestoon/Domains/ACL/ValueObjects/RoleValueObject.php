<?php

namespace Codestoon\Domains\ACL\ValueObjects;

readonly class RoleValueObject
{

    private string $persianTitle;
    private string $englishTitle;
    private bool $isActive;


    public function setPersianTitle(string $value): static
    {
        $this->persianTitle = $value;
        return $this;
    }

    public function getPersianTitle(): string
    {
        return $this->persianTitle;
    }

    public function setEnglishTitle(string $value): static
    {
        $this->englishTitle = $value;
        return $this;
    }

    public function getEnglishTitle(): string
    {
        return $this->englishTitle;
    }

    public function setIsActive(bool $value): static
    {
        $this->isActive = intval($value);
        return $this;
    }

    public function getIsActive(): int
    {
        return intval($this->isActive);
    }
}
