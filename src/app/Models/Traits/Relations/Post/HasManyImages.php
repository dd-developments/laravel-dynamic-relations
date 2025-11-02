<?php

namespace DdDevelopments\DynamicRelations\app\Models\Traits\Relations\Post;

use DdDevelopments\DynamicRelations\app\Models\Image;
use DdDevelopments\DynamicRelations\DynamicRelations;
use Illuminate\Database\Eloquent\Model;

trait HasManyImages
{
    protected static function bootHasManyImages(): void
    {
        DynamicRelations::for(static::class, 'images', function (Model $m) {
            return $m->morphMany(Image::class, 'imageable');
        });
    }
}