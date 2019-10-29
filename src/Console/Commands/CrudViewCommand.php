<?php

namespace Tupy\Generators\Console\Commands;

use Illuminate\Console\Command;

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

        Artisan::call('generator:crud-view-index', ['name' => $name]);

        Artisan::call('generator:crud-view-form', ['name' => $name]);

        Artisan::call('generator:crud-view-create', ['name' => $name]);

        Artisan::call('generator:crud-view-edit', ['name' => $name]);

        Artisan::call('generator:crud-view-show', ['name' => $name]);
    }
}
