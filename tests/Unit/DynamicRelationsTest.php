<?php
declare(strict_types=1);

use DdDevelopments\DynamicRelations\DynamicRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

it('resolves a dynamic hasMany relation', function () {
    // Setup: tabellen
    Schema::create('users', fn (Blueprint $t) => $t->id());
    Schema::create('posts', fn (Blueprint $t) => [$t->id(), $t->foreignId('user_id')]);

    // Models
    $user = new class extends Model { protected $table = 'users'; public $timestamps = false; };
    $post = new class extends Model { protected $table = 'posts'; public $timestamps = false; };

    // Koppel relation dynamisch: $user->posts()
    DynamicRelations::for($user::class, 'posts', function (Model $m) use ($post) {
        /** @var HasMany $rel */
        return $m->hasMany($post::class, 'user_id');
    });

    // Seed
    $u = $user::query()->create();                        // id=1
    $post::query()->create(['user_id' => $u->id]);        // 1 post

    // Assert
    expect($u->posts)->toHaveCount(1);

    DynamicRelations::clear();
});