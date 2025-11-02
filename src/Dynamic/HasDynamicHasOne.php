<?php
// src/Dynamic/HasDynamicHasOne.php
namespace DdDevelopments\DynamicRelations\Dynamic;

use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasDynamicHasOne
{
    /** @var array<string, array{class: class-string, foreignKey?: string, localKey?: string}> */
    public static array $HasOneMap = [];

    public static function bootHasDynamicHasOne(): void
    {
        foreach (static::$HasOneMap as $relation => $cfg) {
            static::resolveRelationUsing($relation, function ($model) use ($cfg): HasOne {
                return $model->hasOne(
                    $cfg['class'],
                    $cfg['foreignKey'] ?? null,
                    $cfg['localKey']   ?? null
                );
            });
        }
    }
}
