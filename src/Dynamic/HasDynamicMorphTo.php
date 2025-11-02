<?php
// src/Dynamic/HasDynamicMorphTo.php
namespace DdDevelopments\DynamicRelations\Dynamic;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait HasDynamicMorphTo
{
    /** @var string[] */
    public static array $MorphToList = [];

    public static function bootHasDynamicMorphTo(): void
    {
        foreach (static::$MorphToList as $relation) {
            static::resolveRelationUsing($relation, function ($model) use ($relation): MorphTo {
                return $model->morphTo($relation);
            });
        }
    }
}
