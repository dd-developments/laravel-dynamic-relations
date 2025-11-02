<?php

namespace DdDevelopments\DynamicRelations\app\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    protected $table = 'role_user';
    protected $guarded = [];
    public $timestamps = false;
}