<?php

namespace DdDevelopments\DynamicRelations;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class DynamicRelationsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/dynamic-relations.php',
            'dynamic-relations'
        );
    }

    public function boot(): void
    {
        // Config publiceerbaar maken: php artisan vendor:publish --tag=dynamic-relations-config
        $this->publishes([
            __DIR__ . '/../config/dynamic-relations.php' => config_path('dynamic-relations.php'),
        ], 'dynamic-relations-config');

        // Declaratieve mappings registreren
        $maps = (array)config('dynamic-relations.relations', []);
        foreach ($maps as $modelClass => $relations) {
            if (!is_string($modelClass) || !class_exists($modelClass)) {
                throw new InvalidArgumentException("dynamic-relations: Model class '{$modelClass}' bestaat niet.");
            }
            foreach ((array)$relations as $name => $def) {
                $resolver = $this->makeResolver($modelClass, $name, (array)$def);
                DynamicRelations::for($modelClass, (string)$name, $resolver);
            }
        }
    }
    /**
     * Bouwt een relation-resolver-closure op basis van de declaratieve definitie.
     *
     * Ondersteunde keys in $def:
     * - type: hasOne|hasMany|belongsTo|belongsToMany|morphOne|morphMany|morphToMany|morphedByMany (vereist)
     * - related: class-string<Model> (vereist voor alle behalve morphToMany/morphedByMany waar het óók vereist is)
     * - foreign_key, local_key (optioneel, afhankelijk van type)
     * - morph_name (voor morphOne/morphMany/morphToMany/morphedByMany)
     * - pivot: string (pivot table voor belongsToMany/morphToMany)
     * - using: class-string (custom pivot model)
     * - where: array van [column => value] die als extra constraints worden toegevoegd
     */
    protected function makeResolver(string $modelClass, string $relation, array $def): \Closure
    {
        $type    = strtolower((string) Arr::get($def, 'type'));
        $related = Arr::get($def, 'related');
        $foreign = Arr::get($def, 'foreign_key');
        $local   = Arr::get($def, 'local_key');
        $morph   = Arr::get($def, 'morph_name');
        $pivot   = Arr::get($def, 'pivot');
        $using   = Arr::get($def, 'using');
        $wheres  = (array) Arr::get($def, 'where', []);

        if (! $type) {
            throw new InvalidArgumentException("dynamic-relations: '{$modelClass}::{$relation}' mist 'type'.");
        }

        // Valideer requireds per type
        $needsRelated = in_array($type, [
            'hasone','hasmany','belongsto','belongstomany','morphone','morphmany','morphtomany','morphedbymany'
        ], true);

        if ($needsRelated && (! is_string($related) || ! class_exists($related))) {
            throw new InvalidArgumentException("dynamic-relations: '{$modelClass}::{$relation}' heeft een ongeldige 'related' class.");
        }

        return function (Model $model) use ($type, $related, $foreign, $local, $morph, $pivot, $using, $wheres) {
            $rel = match ($type) {
                'hasone'       => $model->hasOne($related, $foreign, $local),
                'hasmany'      => $model->hasMany($related, $foreign, $local),
                'belongsto'    => $model->belongsTo($related, $foreign, $local),
                'belongstomany'=> (function () use ($model, $related, $pivot, $foreign, $local, $using) {
                    $r = $model->belongsToMany($related, $pivot, $foreign, $local);
                    if (is_string($using) && class_exists($using)) {
                        $r = $r->using($using);
                    }
                    return $r;
                })(),
                'morphto' => $model->morphTo($morph),
                'morphone'     => $model->morphOne($related, $morph, $local, $foreign),
                'morphmany'    => $model->morphMany($related, $morph, $local, $foreign),
                'morphtomany'  => (function () use ($model, $related, $morph, $pivot, $foreign, $local) {
                    // morphToMany(Related::class, morphName, table = null, foreignPivotKey = null, relatedPivotKey = null, parentKey = null, relatedKey = null)
                    return $model->morphToMany($related, $morph, $pivot, $foreign, $local);
                })(),
                'morphedbymany'=> (function () use ($model, $related, $morph, $pivot, $foreign, $local) {
                    // morphedByMany(Related::class, morphName, table = null, foreignPivotKey = null, relatedPivotKey = null, parentKey = null, relatedKey = null)
                    return $model->morphedByMany($related, $morph, $pivot, $foreign, $local);
                })(),
                default        => throw new InvalidArgumentException("dynamic-relations: onbekend type '{$type}'."),
            };

            // Extra declaratieve constraints
            foreach ($wheres as $column => $value) {
                $rel->where($column, $value);
            }

            return $rel;
        };
    }
}