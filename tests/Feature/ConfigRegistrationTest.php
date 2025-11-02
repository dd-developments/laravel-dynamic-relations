<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

it('registreert relations via config', function () {
    Schema::create('users', fn (Blueprint $t) => $t->id());
    Schema::create('posts', fn (Blueprint $t) => [$t->id(), $t->foreignId('user_id')]);

    $user = new class extends Model { protected $table = 'users'; public $timestamps = false; };
    $post = new class extends Model { protected $table = 'posts'; public $timestamps = false; };

    // Stuur provider via config
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

    // Boot provider manueel (Testbench laadt service providers automatisch als extra is ingesteld.
    // Zo niet, kun je hier expliciet register/boot callen.)
    app()->register(\DdDevelopments\DynamicRelations\DynamicRelationsServiceProvider::class);

    $u = $user::query()->create();
    $post::query()->create(['user_id' => $u->id]);

    expect($u->posts)->toHaveCount(1);
});