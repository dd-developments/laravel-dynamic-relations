<?php

namespace DdDevelopments\DynamicRelations\Models\Traits\Relations\Image;

use DdDevelopments\DynamicRelations\DynamicRelations;
use Illuminate\Database\Eloquent\Model;

trait BelongsToImageable
{
    protected static function bootBelongsToImageable(): void
    {
        DynamicRelations::for(static::class, 'imageable', function (Model $m) {
            return $m->morphTo('imageable');
        });
    }
}