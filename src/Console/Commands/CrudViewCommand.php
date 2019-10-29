<?php

namespace Tupy\Generators\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class CrudViewCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generator:crud-view';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator:crud-view {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all files templated crud view';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        // $path = explode('\\', $name);

        Artisan::call('generator:crud-view-index', ['name' => $name.'\index']);
        echo Artisan::output();

        Artisan::call('generator:crud-view-form', ['name' => $name.'\form']);
        echo Artisan::output();

        Artisan::call('generator:crud-view-create', ['name' => $name.'\create']);
        echo Artisan::output();

        Artisan::call('generator:crud-view-edit', ['name' => $name.'\edit']);
        echo Artisan::output();

        Artisan::call('generator:crud-view-show', ['name' => $name.'\show']);
        echo Artisan::output();
    }
}
