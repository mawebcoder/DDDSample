<?php

namespace Codestoon\Domains\File\Enums;

use Codestoon\Domains\EnumTrait;

enum FileTypeEnum: string
{
    use EnumTrait;

    case VIDEO = 'video';
    case PROFILE = 'profile';
    case COVER = 'cover';
    case ATTACHMENT = 'attachment';
}
