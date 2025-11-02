<?php
// src/Dynamic/HasDynamicBelongsToMany.php
namespace DdDevelopments\DynamicRelations\Dynamic;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasDynamicBelongsToMany
{
    /** @var array<string, array{
     *   class: class-string,
     *   table: string,
     *   foreignPivotKey: string,
     *   relatedPivotKey: string,
     *   parentKey?: string,
     *   relatedKey?: string,
     *   withPivot?: string[]|null,
     *   orderByPivot?: array<string, 'asc'|'desc'>|null
     * }> */
    public static array $BelongsToManyMap = [];

    public static function bootHasDynamicBelongsToMany(): void
    {
        foreach (static::$BelongsToManyMap as $relation => $cfg) {
            static::resolveRelationUsing($relation, function ($model) use ($cfg): BelongsToMany {
                $rel = $model->belongsToMany(
                    $cfg['class'],
                    $cfg['table'],
                    $cfg['foreignPivotKey'],
                    $cfg['relatedPivotKey'],
                    $cfg['parentKey']  ?? null,
                    $cfg['relatedKey'] ?? null
                );

                if (!empty($cfg['withPivot'])) {
                    $rel->withPivot($cfg['withPivot']);
                }
                if (!empty($cfg['orderByPivot'])) {
                    foreach ($cfg['orderByPivot'] as $col => $dir) {
                        $rel->orderByPivot($col, $dir);
                    }
                }
                return $rel;
            });
        }
    }
}

