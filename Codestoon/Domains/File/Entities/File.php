<?php

namespace Codestoon\Domains\File\Entities;

use Codestoon\Domains\BaseModel;
use Codestoon\Domains\File\Aggregations\FileAggregations;
use Codestoon\Infrastructure\File\Factories\FileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends BaseModel
{
    use HasFactory;
    use FileAggregations;

    protected $table = 'files';


    public const    COLUMN_DIRECTORY = 'directory';
    public const    COLUMN_FILE_NAME = 'file_name';
    public const COLUMN_SIZE = 'size';
    public const COLUMN_EXTENSION = 'extension';
    public const COLUMN_DISK = 'disk';
    public const COLUMN_MIME_TYPE = 'mime_type';
    public const COLUMN_BUCKET = 'bucket';
    public const COLUMN_FILE_TYPE = 'file_type';
    public const COLUMN_FILEABLE_ID = 'fileable_id';
    public const COLUMN_FILEABLE_TYPE = 'fileable_type';
    public const COLUMN_PRIVACY = 'privacy';

    public function newFactory(): FileFactory
    {
        return FileFactory::new();
    }
}
