<?php

namespace Tommus\Sprout\Commands;

use Illuminate\Console\Command;

class Run extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sprout:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a Sprout Seeder';

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
        $sprouts = $this->loadSprouts();

        $sprout = $this->choice('Select a sprout to run', $sprouts);

        $sprout = $this->laravel->make($sprout);

        $sprout->setContainer($this->laravel)->setCommand($this)();

        $this->info(sprintf('%s ran successfully.', $sprout->description()));
    }

    /**
     * Loads the sprouts as listed in config/sprouts.php
     *
     * @return array
     */
    public function loadSprouts() : array
    {
        $sprouts = config('sprout.list');

        if ($sprouts === null) {
            $this->error('There are no sprouts defined.');
            return [];
        }

        return $sprouts;
    }
}
