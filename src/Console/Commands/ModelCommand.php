<?php

namespace Tupy\Generators\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;

class ModelCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generator:model';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator:model {name} {--softdelete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate templated model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('softdelete')) {
            return __DIR__.'/../stubs/model-softdelete.stub';
        }

        return __DIR__.'/../stubs/model.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Replace the table name for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return string
     */
    protected function replaceTable(&$stub, $name)
    {
        $name = ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', str_replace($this->getNamespace($name).'\\', '', $name))), '_');

        $table = Str::snake(Str::plural($name));

        $stub = str_replace('DummyTable', $table, $stub);

        return $this;
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
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceTable($stub, $name)->replaceClass($stub, $name);
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
