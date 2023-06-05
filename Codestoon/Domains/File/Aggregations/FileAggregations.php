<?php

namespace Codestoon\Domains\File\Aggregations;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait FileAggregations
{

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }
}
