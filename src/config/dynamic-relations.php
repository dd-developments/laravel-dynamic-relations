<?php

use DdDevelopments\DynamicRelations\app\Models\Image;
use DdDevelopments\DynamicRelations\app\Models\Post;
use DdDevelopments\DynamicRelations\app\Models\Role;
use DdDevelopments\DynamicRelations\app\Models\RoleUser;
use DdDevelopments\DynamicRelations\app\Models\User;

return [
    /*
    |--------------------------------------------------------------------------
    | Declaratieve relation mappings
    |--------------------------------------------------------------------------
    |
    | Structuur:
    | 'relations' => [
    |   ModelClass::class => [
    |     'relationName' => [
    |        'type'        => 'hasOne|hasMany|belongsTo|belongsToMany|morphOne|morphMany|morphToMany|morphedByMany',
    |        'related'     => RelatedModel::class,
    |        'foreign_key' => 'foreign_key_on_related_or_pivot',
    |        'local_key'   => 'local_key_on_parent',
    |        'morph_name'  => 'imageable',     // voor morph*
    |        'pivot'       => 'role_user',     // voor (morph)ToMany
    |        'using'       => PivotModel::class, // custom pivot model
    |        'where'       => ['column' => 'value'] // extra constraints
    |     ],
    |     ...
    |   ],
    | ],
    |
    */

    'relations' => [
        'App\Models\User' => [
            'posts' => [
                'type'        => 'hasMany',
                'related'     => 'App\Models\Post',
                'foreign_key' => 'user_id',
                'local_key'   => 'id',
            ],
            'roles' => [
                'type'        => 'belongsToMany',
                'related'     => 'App\Models\Role',
                'pivot'       => 'role_user',
                'foreign_key' => 'user_id', // pivot kolom naar users
                'local_key'   => 'role_id', // pivot kolom naar roles
                'using'       => 'DdDevelopments\DynamicRelations\app\Models\RoleUser', // <-- STRING, geen ::class
            ],
        ],
        'App\Models\Post' => [
            'author' => [
                'type'        => 'belongsTo',
                'related'     => 'App\Models\User',
                'foreign_key' => 'user_id',
                'owner_key'   => 'id',
            ],
            'images' => [
                'type'       => 'morphMany',
                'related'    => 'App\Models\Image',
                'morph_name' => 'imageable',
            ],
        ],
        'App\Models\Image' => [
            'imageable' => [
                'type'       => 'morphTo',
                'morph_name' => 'imageable',
            ],
        ],
    ],
 ];