<?php

namespace DdDevelopments\DynamicRelations\Models\Traits\Relations\Post;


use DdDevelopments\DynamicRelations\DynamicRelations;
use DdDevelopments\DynamicRelations\Models\Image;
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