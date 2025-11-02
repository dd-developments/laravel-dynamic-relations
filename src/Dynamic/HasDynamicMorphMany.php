<?php
// src/Dynamic/HasDynamicMorphMany.php
namespace DdDevelopments\DynamicRelations\Dynamic;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasDynamicMorphMany
{
    /** @var array<string, array{class: class-string, name: string, type?: string, id?: string, localKey?: string, order?: array{column: string, dir?: 'asc'|'desc'}}> */
    public static array $MorphManyMap = [];

    public static function bootHasDynamicMorphMany(): void
    {
        foreach (static::$MorphManyMap as $relation => $cfg) {
            static::resolveRelationUsing($relation, function ($model) use ($cfg): MorphMany {
                $rel = $model->morphMany(
                    $cfg['class'],
                    $cfg['name'],
                    $cfg['type'] ?? null,
                    $cfg['id'] ?? null,
                    $cfg['localKey'] ?? null
                );
                if (!empty($cfg['order'])) {
                    $rel->orderBy($cfg['order']['column'], $cfg['order']['dir'] ?? 'asc');
                }
                return $rel;
            });
        }
    }
}
