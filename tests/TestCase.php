<?php

declare(strict_types=1);
namespace DdDevelopments\DynamicRelations\Tests;


use DdDevelopments\DynamicRelations\DynamicRelationsServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{

    protected function setUp(): void
    {
        parent::setUp();
        Model::unguard();   // << fixes MassAssignmentException in tests
    }

    protected function tearDown(): void
    {
        Model::reguard();
        parent::tearDown();
    }
    protected function getPackageProviders($app)
    {
        return [
            DynamicRelationsServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        // In-memory SQLite voor snelle, stateless tests
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function defineDatabaseMigrations(): void
    {
        // Package migrations
        // -> Als je package migrations bevat:
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Of, indien je de migrations in de src houdt:
        // $this->loadMigrationsFrom(__DIR__.'/../vendor/dd/quiz/database/migrations');

        // Eventueel inline schema’s (voor simpele tables in tests):
        // Schema::create('...', function (Blueprint $table) { ... });
    }
}