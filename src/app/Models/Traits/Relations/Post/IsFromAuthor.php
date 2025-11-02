<?php

namespace DdDevelopments\DynamicRelations\app\Models\Traits\Relations\Post;

use DdDevelopments\DynamicRelations\app\Models\User;
use DdDevelopments\DynamicRelations\DynamicRelations;
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