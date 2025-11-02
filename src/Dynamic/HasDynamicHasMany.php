<?php
// src/Dynamic/HasDynamicHasMany.php
namespace DdDevelopments\DynamicRelations\Dynamic;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasDynamicHasMany
{
    /** @var array<string, array{class: class-string, foreignKey?: string, localKey?: string, order?: array{column: string, dir?: 'asc'|'desc'}}> */
    public static array $HasManyMap = [];

    public static function bootHasDynamicHasMany(): void
    {
        foreach (static::$HasManyMap as $relation => $cfg) {
            static::resolveRelationUsing($relation, function ($model) use ($cfg): HasMany {
                $rel = $model->hasMany(
                    $cfg['class'],
                    $cfg['foreignKey'] ?? null,
                    $cfg['localKey']   ?? null
                );

                if (!empty($cfg['order'])) {
                    $rel->orderBy($cfg['order']['column'], $cfg['order']['dir'] ?? 'asc');
                }
                return $rel;
            });
        }
    }
}
