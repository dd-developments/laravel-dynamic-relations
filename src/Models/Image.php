<?php

namespace DdDevelopments\DynamicRelations\Models;

use DdDevelopments\DynamicRelations\Models\Traits\Relations\Image\BelongsToImageable;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use BelongsToImageable;
    protected $guarded = [];
    public $timestamps = false;
}