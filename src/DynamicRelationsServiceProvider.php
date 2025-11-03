<?php

namespace DdDevelopments\DynamicRelations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class DynamicRelationsServiceProvider extends ServiceProvider
{
    /** Geef het eerste bestaande pad terug. */
    private function firstExisting(array $paths): ?string
    {
        foreach ($paths as $p) {
            if (is_file($p)) {
                return $p;
            }
        }
        return null;
    }

    public function register(): void
    {
        // Merge config (geen hard require)
        $config = $this->firstExisting([
            dirname(__DIR__) . '/config/dynamic-relations.php', // src/.. → config
            __DIR__ . '/../config/dynamic-relations.php',       // src/ + config
            __DIR__ . '/../../config/dynamic-relations.php',    // src/Providers + config
        ]);

        if ($config) {
            $this->mergeConfigFrom($config, 'dynamic-relations');
        }
    }

    public function boot(): void
    {
        // Publish mapping (alleen in console)
        $config = $this->firstExisting([
            dirname(__DIR__) . '/config/dynamic-relations.php',
            __DIR__ . '/../config/dynamic-relations.php',
            __DIR__ . '/../../config/dynamic-relations.php',
        ]);

        if ($config && $this->app->runningInConsole()) {
            $map = [$config => config_path('dynamic-relations.php')];
            $this->publishes($map, 'dynamic-relations-config');
            $this->publishes($map, 'config'); // alias
        }

        // Relaties registreren
        $relations = config('dynamic-relations.relations');
        if (!is_array($relations)) {
            return;
        }

        foreach ($relations as $parentClass => $defs) {
            if (!is_string($parentClass) || !class_exists($parentClass)) {
                continue; // parent bestaat niet → overslaan
            }
            if (!is_array($defs)) {
                continue;
            }

            foreach ($defs as $name => $def) {
                $type       = strtolower((string) Arr::get($def, 'type'));
                $related    = Arr::get($def, 'related');   // string of null (bij morphTo)
                $foreignKey = Arr::get($def, 'foreign_key');
                $localKey   = Arr::get($def, 'local_key');
                $ownerKey   = Arr::get($def, 'owner_key');
                $pivotTable = Arr::get($def, 'pivot');
                $using      = Arr::get($def, 'using');
                $morphName  = Arr::get($def, 'morph_name');
                $where      = (array) Arr::get($def, 'where', []);

                if ($type !== 'morphto') {
                    if (!is_string($related) || !class_exists($related)) {
                        throw new InvalidArgumentException("DynamicRelations: [{$parentClass}->{$name}] related class niet gevonden: " . (string) $related);
                    }
                }

                /** @var class-string<Model> $parentClass */
                $parentClass::resolveRelationUsing($name, function (Model $model) use ($type, $related, $foreignKey, $localKey, $ownerKey, $pivotTable, $using, $morphName, $where) {
                    switch ($type) {
                        case 'hasone':
                            $rel = $model->hasOne($related, $foreignKey, $localKey);
                            break;
                        case 'hasmany':
                            $rel = $model->hasMany($related, $foreignKey, $localKey);
                            break;
                        case 'belongsto':
                            $rel = $model->belongsTo($related, $foreignKey, $ownerKey);
                            break;
                        case 'belongstomany':
                            $rel = $model->belongsToMany($related, $pivotTable, $foreignKey, $localKey);
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

                    foreach ($where as $col => $val) {
                        $rel->where($col, $val);
                    }

                    return $rel;
                });
            }
        }
    }
}