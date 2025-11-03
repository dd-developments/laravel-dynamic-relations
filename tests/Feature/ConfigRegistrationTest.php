<?php

use DdDevelopments\DynamicRelations\DynamicRelationsServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

beforeEach(function () {
    Model::unguard();
});

afterEach(function () {
    Model::reguard();
});

it('registreert relations via config', function () {
    Schema::create('users', fn (Blueprint $t) => $t->id());
    Schema::create('posts', fn (Blueprint $t) => [$t->id(), $t->foreignId('user_id')]);

    $user = new class extends Model { protected $table = 'users'; public $timestamps = false; };
    $post = new class extends Model { protected $table = 'posts'; public $timestamps = false; };

    // Zet mapping voor de anonieme klassenaam
    Config::set('dynamic-relations.relations', [
        $user::class => [
            'posts' => [
                'type'        => 'hasMany',
                'related'     => $post::class,
                'foreign_key' => 'user_id',
                'local_key'   => 'id',
            ],
        ],
    ]);

    // <<< BELANGRIJK: provider opnieuw boosten nadat config gezet is
    $provider = new DynamicRelationsServiceProvider(app());
    $provider->boot();

    $u = $user::query()->create();
    $post::query()->create(['user_id' => $u->id]);

    expect($u->posts)->toHaveCount(1);
});
