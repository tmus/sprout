<?php

namespace Tommus\Sprout\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

class Make extends Command
{
    use DetectsApplicationNamespace;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sprout:make {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new Sprout Seeder';

    /**
     * The name of the created sprout.
     *
     * @var string
     */
    protected $sprout;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->createDirectory();

        $this->sprout = ucfirst($this->argument('name'));

        file_put_contents(
            app_path(sprintf("Sprouts/%s.php", $this->sprout)),
            $this->compileSproutStub()
        );
    }

    /**
     * Creates the app/Sprouts directory, if it doesn't exist.
     *
     * @return void
     */
    protected function createDirectory()
    {
        if (! is_dir($directory = app_path('Sprouts'))) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * Generate a Sprout stub.
     *
     * @return string
     */
    protected function compileSproutStub()
    {
        $stub = str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__.'/stubs/Sprout.stub')
        );

        return str_replace(
            '{{sprout}}',
            $this->sprout,
            $stub
        );
    }
}
