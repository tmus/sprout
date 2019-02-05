<?php

namespace Tommus\Sprout;

use Illuminate\Console\Command;
use Illuminate\Container\Container;

class Sprout
{
    /**
     * Invokes the class.
     *
     * @return mixed
     */
    public function __invoke()
    {
        $this->beforeRun();

        $this->run();

        $this->afterRun();
    }

    /**
     * Returns the description of the Sprout.
     *
     * @return string
     */
    public function description()
    {
        return $this->description ?? get_class($this);
    }

    /**
     * Calls another Sprout.
     *
     * @param string $class The Sprout to instantiate.
     *
     * @return void
     */
    protected function call(string $class)
    {
        $sprout = $this->container->make($class);

        $sprout->setContainer($this->container)->setCommand($this->command);

        $sprout->__invoke();
    }

    /**
     * Actions to carry out before running the Sprout.
     *
     * @return void
     */
    public function beforeRun()
    {
        $this->command->getOutput()->writeln(
            sprintf("<comment>Running:</comment> %s", $this->description())
        );
    }

    /**
     * Actions to carry out after running the Sprout.
     *
     * @return void
     */
    public function afterRun()
    {
        $this->command->getOutput()->writeln(
            sprintf("<info>Finished:</info> %s", $this->description())
        );
    }

    /**
     * Sets the container for the Sprout.
     *
     * This allows Sproutception to happen via the `call()` method.
     *
     * @param Container $container The Laravel service container.
     *
     * @return self
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Sets the artisan command for the Sprout.
     *
     * This allows Sprouts to pass messages back up to the terminal.
     *
     * @param Command $command The artisan command instance.
     *
     * @return self
     */
    public function setCommand(Command $command)
    {
        $this->command = $command;

        return $this;
    }
}
