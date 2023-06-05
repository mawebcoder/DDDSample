<?php

namespace Codestoon\Domains\File\Enums;

use Codestoon\Domains\EnumTrait;

enum FilePrivacyEnum: int
{
    use EnumTrait;

    case PRIVATE = 0;
    case PUBLIC = 1;
}
