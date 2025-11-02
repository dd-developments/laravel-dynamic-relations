<?php
// src/Dynamic/HasDynamicMorphOne.php
namespace DdDevelopments\DynamicRelations\Dynamic;

use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasDynamicMorphOne
{
    /** @var array<string, array{class: class-string, name: string, type?: string, id?: string, localKey?: string}> */
    public static array $MorphOneMap = [];

    public static function bootHasDynamicMorphOne(): void
    {
        foreach (static::$MorphOneMap as $relation => $cfg) {
            static::resolveRelationUsing($relation, function ($model) use ($cfg): MorphOne {
                // $cfg['name'] = morph name on child (e.g. 'imageable')
                return $model->morphOne(
                    $cfg['class'],
                    $cfg['name'],
                    $cfg['type'] ?? null,
                    $cfg['id'] ?? null,
                    $cfg['localKey'] ?? null
                );
            });
        }
    }
}
