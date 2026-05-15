<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class ApiResourceCollectionMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:apiResourceCollection {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new ApiResourceCollection class';

    protected function getStub()
    {
        return __DIR__ . '/Stubs/api-resource-collection.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace. '/Http/Resources';
    }
}
