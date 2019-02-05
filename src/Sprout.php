<?php

namespace Tommus\Sprout;

use Illuminate\Console\Command;
use Illuminate\Container\Container;

class Sprout
{
    public function __invoke()
    {
        // might have to call another artisan command here, so that each playbook
        // can return a message and abort if necessary. Hmm.........
        // https://laravel.com/docs/5.7/artisan#calling-commands-from-other-commands

        // this looks good:
        // return $class->setContainer($this->laravel)->setCommand($this);
        // from SeedCommand line 78
        $this->command->getOutput()->writeln(sprintf("<info>Running</info> %s", $this->description()));
        $this->run();
        $this->command->getOutput()->writeln(sprintf("<info>Finished</info> %s", $this->description()));

    }

    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    public function setCommand(Command $command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Returns the description of the Sprout.
     *
     * @return string
     */
    protected function description()
    {
        return $this->description ?? get_class($this);
    }

    protected function call(string $class)
    {
        $sprout = $this->container->make($class);

        $sprout->setContainer($this->container)->setCommand($this->command);

        $sprout->__invoke();
    }
}