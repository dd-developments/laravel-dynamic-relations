<?php

declare(strict_types=1);
namespace DdDevelopments\DynamicRelations\Tests;


use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    // Als je een service provider hebt:
    // protected function getPackageProviders($app)
    // {
    //     return [\DdDevelopments\DynamicRelations\DynamicRelationsServiceProvider::class];
    // }

    protected function defineEnvironment($app): void
    {
        // Extra app-config indien nodig
        // $app['config']->set('database.default', 'sqlite');
    }
}