<?php

namespace Tupy\Generators;

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider
{
    protected $commands = [
        \Tupy\Generators\Console\Commands\ConfigCommand::class,
        \Tupy\Generators\Console\Commands\CrudModelCommand::class,
        \Tupy\Generators\Console\Commands\CrudControllerCommand::class,
        \Tupy\Generators\Console\Commands\CrudRequestCommand::class,
        \Tupy\Generators\Console\Commands\CrudCommand::class,
        \Tupy\Generators\Console\Commands\ModelCommand::class,
        \Tupy\Generators\Console\Commands\RequestCommand::class,
        \Tupy\Generators\Console\Commands\ViewCommand::class,
        \Tupy\Generators\Console\Commands\AddRouteContent::class,
        \Tupy\Generators\Console\Commands\AddSidebarContent::class

    ];

    // public $routeFilePath = '/routes/web.php';

    public function boot()
    {
        $this->loadConfigs();

        $this->loadRoutesFrom(__DIR__.'/web.php');

        if ($this->app->runningInConsole()) {
            // $this->publishes([
            //     __DIR__.'/routes/admin.php' => base_path('/routes/admin.php')
            // ], 'generator-route-admin');

            $this->publishes([
                __DIR__.'/../config/generator.php' => config_path('generator.php'),
            ], 'generator-config');
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    public function loadConfigs()
    {
        // add the root disk to filesystem configuration
        app()->config['filesystems.disks.'.config('generator.disk')] = [
            'driver' => 'local',
            'root'   => base_path(),
        ];
    }
}
