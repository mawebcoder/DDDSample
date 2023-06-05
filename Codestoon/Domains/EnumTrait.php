<?php

namespace Codestoon\Domains;

trait EnumTrait
{

    public static function toArray(): array
    {
        $cases = static::cases();

        $array = [];

        foreach ($cases as $case) {
            $array[$case->name] = $case->value;
        }

        return $array;
    }
}
