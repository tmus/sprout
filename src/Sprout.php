<?php

namespace Tommus\Sprout;

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
        $this->run();

        return [
            'type' => 'info',
            'body' => 'Sprout finished.'
        ];
    }
}