<?php

namespace DdDevelopments\DynamicRelations;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class DynamicRelationsServiceProvider extends ServiceProvider
{
     protected function findConfigPath(): ?string
    {
        $candidates = [
            __DIR__ . '/../config/dynamic-relations.php',   // provider direct onder src/
            __DIR__ . '/../../config/dynamic-relations.php',// provider onder src/Providers/...
            dirname(__DIR__) . '/config/dynamic-relations.php', // src/.. → package root → config
        ];

        foreach ($candidates as $path) {
            if (is_file($path)) {
                return $path;
            }
        }
        return null;
    }

    public function register(): void
    {

        $this->mergeConfigFrom(__DIR__ . '/config/dynamic-relations.php', 'dynamic-relations');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '.config/dynamic-relations.php' => config_path('dynamic-relations.php'),
        ], 'config');

        $relations = (array) config('dynamic-relations.relations', []);

        foreach ($relations as $parentClass => $defs) {
            if (!class_exists($parentClass)) {
                // parent model bestaat niet — sla over
                continue;
            }
            foreach ($defs as $name => $def) {
                $type   = strtolower((string) Arr::get($def, 'type'));
                $related = Arr::get($def, 'related');

                $foreignKey = Arr::get($def, 'foreign_key');
                $localKey   = Arr::get($def, 'local_key');
                $ownerKey   = Arr::get($def, 'owner_key'); // voor belongsTo
                $pivotTable = Arr::get($def, 'pivot');
                $using      = Arr::get($def, 'using');
                $morphName  = Arr::get($def, 'morph_name');
                $where      = (array) Arr::get($def, 'where', []);

                if (in_array($type, ['morphto'], true)) {
                    // morphTo heeft geen required related class
                } else {
                    if (!is_string($related) || !class_exists($related)) {
                        throw new InvalidArgumentException("DynamicRelations: [{$parentClass}->{$name}] related class niet gevonden.");
                    }
                }

                // Registreer enkel op het specifieke parent model
                $parentClass::resolveRelationUsing($name, function (Model $model) use ($type, $related, $foreignKey, $localKey, $ownerKey, $pivotTable, $using, $morphName, $where) {
                    switch ($type) {
                        case 'hasone':
                            $rel = $model->hasOne($related, $foreignKey, $localKey);
                            break;

                        case 'hasmany':
                            $rel = $model->hasMany($related, $foreignKey, $localKey);
                            break;

                        case 'belongsto':
                            // belongsTo(signature): (related, foreignKey = null, ownerKey = null, relation = null)
                            $rel = $model->belongsTo($related, $foreignKey, $ownerKey);
                            break;

                        case 'belongstomany':
                            // belongsToMany(signature): (related, table = null, foreignPivotKey = null, relatedPivotKey = null, parentKey = null, relatedKey = null, relation = null)
                            $rel = $model->belongsToMany(
                                $related,
                                $pivotTable,
                                // We hergebruiken keys zoals je ze al in config gebruikt:
                                // foreign_key => pivot kolom naar parent
                                // local_key   => pivot kolom naar related
                                $foreignKey,
                                $localKey
                            );
                            if (is_string($using) && class_exists($using)) {
                                $rel = $rel->using($using);
                            }
                            break;

                        case 'morphone':
                            $rel = $model->morphOne($related, $morphName);
                            break;

                        case 'morphmany':
                            $rel = $model->morphMany($related, $morphName);
                            break;

                        case 'morphto':
                            $rel = $model->morphTo($morphName);
                            break;

                        default:
                            throw new InvalidArgumentException("DynamicRelations: unsupported type [{$type}].");
                    }

                    // Eventuele extra constraints
                    foreach ($where as $col => $val) {
                        $rel->where($col, $val);
                    }

                    return $rel;
                });
            }
        }
    }
}
