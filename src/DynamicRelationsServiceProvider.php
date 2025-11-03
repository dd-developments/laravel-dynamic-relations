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
        // Kandidaten (werken in zowel dist als source)
        $candidates = [
            dirname(__DIR__) . '/config/dynamic-relations.php', // package root/config
            __DIR__ . '/../config/dynamic-relations.php',       // src/config
            __DIR__ . '/../../config/dynamic-relations.php',    // src/Providers/../config
        ];

        // Merge + publishes REGISTREREN HIER (met static::) zodat VendorPublishCommand ze altijd ziet
        foreach ($candidates as $path) {
            if (is_file($path)) {
                $this->mergeConfigFrom($path, 'dynamic-relations');

                // registreer beide tags – geen guards, geen console check
                static::publishes([$path => config_path('dynamic-relations.php')], 'dynamic-relations-config');
                static::publishes([$path => config_path('dynamic-relations.php')], 'config');
                break; // eerste hit is genoeg
            }
        }
    }

    public function boot(): void
    {
        // Alleen je relation-registratie; géén publishes hier
        $relations = config('dynamic-relations.relations');
        if (! is_array($relations)) {
            return;
        }

        foreach ($relations as $parentClass => $defs) {
            if (!is_string($parentClass) || !class_exists($parentClass) || !is_array($defs)) {
                continue;
            }
            foreach ($defs as $name => $def) {
                $type       = strtolower((string) \Illuminate\Support\Arr::get($def, 'type'));
                $related    = \Illuminate\Support\Arr::get($def, 'related');
                $foreignKey = \Illuminate\Support\Arr::get($def, 'foreign_key');
                $localKey   = \Illuminate\Support\Arr::get($def, 'local_key');
                $ownerKey   = \Illuminate\Support\Arr::get($def, 'owner_key');
                $pivotTable = \Illuminate\Support\Arr::get($def, 'pivot');
                $using      = \Illuminate\Support\Arr::get($def, 'using');
                $morphName  = \Illuminate\Support\Arr::get($def, 'morph_name');
                $where      = (array) \Illuminate\Support\Arr::get($def, 'where', []);

                if ($type !== 'morphto') {
                    if (!is_string($related) || !class_exists($related)) {
                        throw new \InvalidArgumentException("DynamicRelations: [{$parentClass}->{$name}] related class niet gevonden: " . (string) $related);
                    }
                }

                /** @var class-string<\Illuminate\Database\Eloquent\Model> $parentClass */
                $parentClass::resolveRelationUsing($name, function (\Illuminate\Database\Eloquent\Model $model) use ($type, $related, $foreignKey, $localKey, $ownerKey, $pivotTable, $using, $morphName, $where) {
                    switch ($type) {
                        case 'hasone':        $rel = $model->hasOne($related, $foreignKey, $localKey); break;
                        case 'hasmany':       $rel = $model->hasMany($related, $foreignKey, $localKey); break;
                        case 'belongsto':     $rel = $model->belongsTo($related, $foreignKey, $ownerKey); break;
                        case 'belongstomany': $rel = $model->belongsToMany($related, $pivotTable, $foreignKey, $localKey); if (is_string($using) && class_exists($using)) { $rel = $rel->using($using); } break;
                        case 'morphone':      $rel = $model->morphOne($related, $morphName); break;
                        case 'morphmany':     $rel = $model->morphMany($related, $morphName); break;
                        case 'morphto':       $rel = $model->morphTo($morphName); break;
                        default: throw new \InvalidArgumentException("DynamicRelations: unsupported type [{$type}].");
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