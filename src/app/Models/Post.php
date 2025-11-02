<?php

namespace DdDevelopments\DynamicRelations\app\Models;

use DdDevelopments\DynamicRelations\app\Models\Traits\Relations\Post\HasManyImages;
use DdDevelopments\DynamicRelations\app\Models\Traits\Relations\Post\IsFromAuthor;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use IsFromAuthor, HasManyImages;
    protected $guarded = [];
    public $timestamps = false;
}