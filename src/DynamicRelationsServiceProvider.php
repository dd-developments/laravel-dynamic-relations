<?php

namespace DdDevelopments\DynamicRelations;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class DynamicRelationsServiceProvider extends ServiceProvider
{
    protected function findConfigPath(): ?string
    {
        $candidates = [
            __DIR__ . '/../config/dynamic-relations.php',      // src/ + config
            __DIR__ . '/../../config/dynamic-relations.php',   // src/Providers + config
            dirname(__DIR__) . '/config/dynamic-relations.php' // src/.. → config
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
    // Config samenvoegen zodra we 'm vinden
    foreach ([
        __DIR__ . '/../config/dynamic-relations.php',     // src/
        __DIR__ . '/../../config/dynamic-relations.php',  // src/Providers/
    ] as $path) {
        if (is_file($path)) {
            $this->mergeConfigFrom($path, 'dynamic-relations');
            break;
        }
    }
}

public function boot(): void
{
    // Publish mapping registreren (zonder afhankelijk te zijn van findConfigPath())
    $configPath = null;
    foreach ([
        __DIR__ . '/../config/dynamic-relations.php',     // src/
        __DIR__ . '/../../config/dynamic-relations.php',  // src/Providers/
    ] as $path) {
        if (is_file($path)) { $configPath = $path; break; }
    }

    if ($configPath) {
        $mapping = [$configPath => config_path('dynamic-relations.php')];

        // jouw tag
        $this->publishes($mapping, 'dynamic-relations-config');

        // extra alias (veel devs zoeken op --tag=config)
        $this->publishes($mapping, 'config');
    }

        // Hierna mag je veilig config lezen
        $relations = (array) config('dynamic-relations.relations', []);

        foreach ($relations as $parentClass => $defs) {
            if (!class_exists($parentClass)) {
                continue;
            }

            foreach ($defs as $name => $def) {
                $type      = strtolower((string) Arr::get($def, 'type'));
                $related   = Arr::get($def, 'related');
                $foreignKey= Arr::get($def, 'foreign_key');
                $localKey  = Arr::get($def, 'local_key');
                $ownerKey  = Arr::get($def, 'owner_key');
                $pivotTable= Arr::get($def, 'pivot');
                $using     = Arr::get($def, 'using');
                $morphName = Arr::get($def, 'morph_name');
                $where     = (array) Arr::get($def, 'where', []);

                if ($type !== 'morphto') {
                    if (!is_string($related) || !class_exists($related)) {
                        throw new InvalidArgumentException("DynamicRelations: [{$parentClass}->{$name}] related class niet gevonden.");
                    }
                }

                $parentClass::resolveRelationUsing($name, function (Model $model) use ($type, $related, $foreignKey, $localKey, $ownerKey, $pivotTable, $using, $morphName, $where) {
                    switch ($type) {
                        case 'hasone':        $rel = $model->hasOne($related, $foreignKey, $localKey); break;
                        case 'hasmany':       $rel = $model->hasMany($related, $foreignKey, $localKey); break;
                        case 'belongsto':     $rel = $model->belongsTo($related, $foreignKey, $ownerKey); break;
                        case 'belongstomany': $rel = $model->belongsToMany($related, $pivotTable, $foreignKey, $localKey); if (is_string($using) && class_exists($using)) { $rel = $rel->using($using); } break;
                        case 'morphone':      $rel = $model->morphOne($related, $morphName); break;
                        case 'morphmany':     $rel = $model->morphMany($related, $morphName); break;
                        case 'morphto':       $rel = $model->morphTo($morphName); break;
                        default: throw new InvalidArgumentException("DynamicRelations: unsupported type [{$type}].");
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
