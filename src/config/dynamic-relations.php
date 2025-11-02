<?php
use DdDevelopments\DynamicRelations\app\Models\User;
use DdDevelopments\DynamicRelations\app\Models\Post;
use DdDevelopments\DynamicRelations\app\Models\Role;
use DdDevelopments\DynamicRelations\app\Models\Image;

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
         User::class => [
             'posts' => [
                 'type'        => 'hasMany',
                 'related'     => Post::class,
                 'foreign_key' => 'user_id',
                 'local_key'   => 'id',
             ],
             'roles' => [
                 'type'        => 'belongsToMany',
                 'related'     => Role::class,
                 'pivot'       => 'role_user',
                 'foreign_key' => 'user_id',
                 'local_key'   => 'role_id',
                 'using'       => RoleUser::class,
             ],
         ],
         Post::class => [
             'author' => [
                 'type'        => 'belongsTo',
                 'related'     => User::class,
                 'foreign_key' => 'user_id',
                 'local_key'   => 'id',
             ],
             'images' => [
                 'type'       => 'morphMany',
                 'related'    => Image::class,
                 'morph_name' => 'imageable',
             ],
         ],
         Image::class => [
             'imageable' => [
                 'type'       => 'morphTo',
                 'morph_name' => 'imageable',
             ],
         ],
     ],
 ];