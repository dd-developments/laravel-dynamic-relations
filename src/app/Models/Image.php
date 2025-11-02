<?php

namespace DdDevelopments\DynamicRelations\app\Models;

use DdDevelopments\DynamicRelations\app\Models\Traits\Relations\Image\BelongsToImageable;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use BelongsToImageable;
    protected $guarded = [];
    public $timestamps = false;
}