<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TraitMaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name : The name of the trait.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new trait in the Library directory.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path('Http/Library/' . $name . '.php');

        if (File::exists($path)) {
            return $this->error('The trait already exists!');
        }

        File::put($path, $this->buildClass($name));

        $this->info('The trait has been created successfully.');
    }

    /**
     * Build the trait class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = File::get(__DIR__.'/stubs/trait.stub');

        return str_replace('{{trait}}', $name, $stub);
    }
}
