<?php

namespace DdDevelopments\DynamicRelations;

use Illuminate\Database\Eloquent\Model;

final class DynamicRelations
{
    /** @var array<class-string<Model>, array<string, callable>> */
    private static array $maps = [];

    /** Registreer een relation-resolver (bv. 'posts' op User::class) */
    public static function for(string $modelClass, string $relation, callable $resolver): void
    {
        self::$maps[$modelClass][$relation] = $resolver;

        /** @var class-string<Model> $modelClass */
        $modelClass::resolveRelationUsing($relation, function (Model $model) use ($resolver) {
            return $resolver($model);
        });
    }

    /** Handig voor tests */
    public static function clear(): void
    {
        self::$maps = [];
    }
}