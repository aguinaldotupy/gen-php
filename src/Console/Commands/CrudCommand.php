<?php

namespace Backpack\Generators\Console\Commands;

use Artisan;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class CrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator:crud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a CRUD interface: Controller, Model, Request';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));

        // Create the CRUD Controller and show output
        Artisan::call('generator:crud-controller', ['name' => $name]);
        echo Artisan::output();

        // Create the CRUD Model and show output
        Artisan::call('generator:crud-model', ['name' => $name]);
        echo Artisan::output();

        // Create the CRUD Request and show output
        Artisan::call('generator:crud-request', ['name' => $name]);
        echo Artisan::output();

        // Create the CRUD route
        Artisan::call('generator:add-custom-route', [
            'code' => "Route::crud('".$this->argument('name')."', '".$name."CrudController');",
        ]);
        echo Artisan::output();

        // Create the sidebar item
        Artisan::call('generator:add-sidebar-content', [
            'code' => "<li class='nav-item'><a class='nav-link' href='{{ backpack_url('".$this->argument('name')."') }}'><i class='nav-icon fa fa-question'></i> ".Str::plural($name).'</a></li>',
        ]);

        echo Artisan::output();
    }
}
