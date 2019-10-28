<?php

namespace Tupy\Generators;

use Illuminate\Support\ServiceProvider;

use Tupy\Generators\Console\Commands\CrudCommand;
use Tupy\Generators\Console\Commands\ViewCommand;
use Tupy\Generators\Console\Commands\ModelCommand;
use Tupy\Generators\Console\Commands\ConfigCommand;
use Tupy\Generators\Console\Commands\RequestCommand;
use Tupy\Generators\Console\Commands\CrudModelCommand;
use Tupy\Generators\Console\Commands\CrudRequestCommand;
use Tupy\Generators\Console\Commands\CrudControllerCommand;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class GeneratorsServiceProvider extends ServiceProvider
{
    protected $commands = [
        ConfigCommand::class,
        CrudModelCommand::class,
        CrudControllerCommand::class,
        CrudOperationCommand::class,
        CrudRequestCommand::class,
        CrudCommand::class,
        ModelCommand::class,
        RequestCommand::class,
        ViewCommand::class,
    ];

    public function boot(Router $router)
    {
        $this->loadConfigs();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/routes/admin.php' => base_path('/routes/admin.php')
            ], 'generator-route-admin');
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
