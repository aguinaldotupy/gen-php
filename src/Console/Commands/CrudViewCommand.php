<?php

namespace Tupy\Generators\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CrudViewCommand extends GeneratorCommand
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
    protected $signature = 'generator:crud-view {name} {--crud}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate templated view';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'View';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('crud')) {
            return [
                __DIR__.'/../stubs/view-index.stub',
                __DIR__.'/../stubs/view-create.stub',
                __DIR__.'/../stubs/view-edit.stub',
                __DIR__.'/../stubs/view-form.stub',
                __DIR__.'/../stubs/view-show.stub'
            ];
        }

        return __DIR__.'/../stubs/view.stub';
    }

    /**
     * Alias for the fire method.
     *
     * In Laravel 5.5 the fire() method has been renamed to handle().
     * This alias provides support for both Laravel 5.4 and 5.5.
     */
    public function handle()
    {
        $this->fire();
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {
        $name = $this->getNameInput();

        $path = $this->getPath($name);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        if ($this->option('crud')) {
            $this->files->put($path, $this->buildClass('index'));
            $this->files->put($path, $this->buildClass('create'));
            $this->files->put($path, $this->buildClass('edit'));
            $this->files->put($path, $this->buildClass('form'));
            $this->files->put($path, $this->buildClass('show'));
        } else {
            $this->files->put($path, $this->buildClass($name));
        }

        $this->info($this->type.' created successfully.');
    }

    /**
     * Determine if the class already exists.
     *
     * @param string $name
     *
     * @return bool
     */
    protected function alreadyExists($name)
    {
        return $this->files->exists($this->getPath($name));
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        return $this->laravel['path'].'/../resources/views/'.str_replace('\\', '/', $name).'.blade.php';
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        return $this->files->get($this->getStub());
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

        ];
    }
}
