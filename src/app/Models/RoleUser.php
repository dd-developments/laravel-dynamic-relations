<?php

namespace DdDevelopments\DynamicRelations\app\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    protected $table = 'role_user';
    public $timestamps = false;
    public $incrementing = false;   // <- belangrijk als je pivot geen pk heeft
    protected $primaryKey = null;
    protected $guarded = [];
}