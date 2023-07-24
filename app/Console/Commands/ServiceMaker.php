<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ServiceMaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name : The name of the service.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service in the Services directory.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path('Services/' . $name . '.php');

        if (File::exists($path)) {
            return $this->error('The service already exists!');
        }

        File::put($path, $this->buildClass($name));

        $this->info('The service has been created successfully.');
    }

    /**
     * Build the service class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = File::get(__DIR__.'/stubs/service.stub');

        return str_replace('{{service}}', $name, $stub);
    }
}
