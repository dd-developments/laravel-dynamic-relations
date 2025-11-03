<?php

namespace DdDevelopments\DynamicRelations\Models\Traits\Relations\Post;

use DdDevelopments\DynamicRelations\DynamicRelations;
use DdDevelopments\DynamicRelations\Models\User;
use Illuminate\Database\Eloquent\Model;

trait IsFromAuthor
{
    protected static function bootIsFromAuthor(): void
    {
        DynamicRelations::for(static::class, 'author', function (Model $m) {
            return $m->belongsTo(User::class, 'user_id');
        });
    }
}