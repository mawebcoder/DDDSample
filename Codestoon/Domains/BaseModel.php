<?php

namespace Codestoon\Domains;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BaseModel extends Model
{

    public const   COLUMN_ID = 'id';
    public const   COLUMN_UPDATED_AT = 'updated_at';
    public const   COLUMN_CREATED_AT = 'created_at';
    public const   COLUMN_DELETED_AT = 'deleted_at';

    public static function getById($id, bool $withTrashed = false): ?static
    {
        $key = static::class . ":" . $id;

        if ($withTrashed) {
            $key .= ":with-trashed";
        }

        return Cache::remember($key, config('cache.ttl'), function () use ($withTrashed, $id) {
            $query = static::query();

            if ($withTrashed) {
                $query->withTrashed();
            }

            return $query->find($id);
        });
    }
}
