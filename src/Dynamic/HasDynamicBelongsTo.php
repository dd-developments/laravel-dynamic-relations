<?php
// src/Dynamic/HasDynamicBelongsTo.php
namespace DdDevelopments\DynamicRelations\Dynamic;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasDynamicBelongsTo
{
    /** @var array<string, array{class: class-string, foreignKey?: string, ownerKey?: string}> */
    public static array $BelongsToMap = [];

    public static function bootHasDynamicBelongsTo(): void
    {
        foreach (static::$BelongsToMap as $relation => $cfg) {
            static::resolveRelationUsing($relation, function ($model) use ($cfg): BelongsTo {
                return $model->belongsTo(
                    $cfg['class'],
                    $cfg['foreignKey'] ?? null,
                    $cfg['ownerKey']   ?? null
                );
            });
        }
    }
}
